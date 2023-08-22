<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();

        return view('dashboard.documents.index', compact('documents'));
    }

    public function show(int $id)
    {
        if (\Auth::user()->hasPermissionTo('view trashed')) {
            $document = Document::withTrashed()->where('id', $id)->firstOrFail();

            if($document->trashed()) {
                \Session::flash('error','Estas viendo un registro que fue borrado. Esta almacenado para motivos de auditoría y solo puede ser visto por administradores.');
            }
        }
        else {
            $document = Document::where('id', $id)->firstOrFail();
        }

        return view('dashboard.documents.show', compact('document'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('dashboard.documents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'version' => ['required', 'string'],
            'category' => ['required'],
            'document' => ['required', 'mimes:pdf', 'max:40960'],
        ]);

        $category = Category::where('name', $request->input('category'))->firstOrFail();

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        $document = Document::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'version' => $request->input('version'),
            'document_path' => $documentPath,
        ]);

        $document->category()->associate($category);
        $document->save();

        activity()
            ->performedOn($document)
            ->withProperties([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'version' => $request->input('version'),
                'category' => $category->name,
                'document_path' => $documentPath,
            ])->log('Created resource '.$document->name);

        return redirect()->route('dashboard.documents.show', ['id' => $document->id]);
    }

    public function edit(int $id)
    {
        $document = Document::where('id', $id)->firstOrFail();
        $categories = Category::all();

        return view('dashboard.documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $document = Document::where('id', $id)->first();

        if (! $document) {
            return redirect()->route('dashboard.documents.index')->with('error', 'No se pudo editar el documento!');
        }

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'version' => ['required', 'string'],
            'category' => ['required'],
            'document' => ['mimes:pdf', 'max:40960'],
        ]);

        // Check for new document file, otherwise keep using the old one.
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = request->file('document')->store('documents', 'public');
        } else {
            $documentPath = $document->document_path;
        }

        $document->name = $request->input('name');
        $document->version = $request->input('version');
        $document->description = $request->input('description');

        $category = Category::where('name', $request->input('category'))->firstOrFail();
        $document->category()->dissociate();
        $document->category()->associate($category);

        $document->save();

        activity()
            ->performedOn($document)
            ->withProperties([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'version' => $request->input('version'),
                'category' => $category->name,
                'document_path' => $documentPath,
            ])->log('Updated resource '.$document->name);

        return redirect()->route('dashboard.documents.show', ['id' => $document->id]);
    }

    public function destroy(int $id)
    {
        $document = Document::where('id', $id)->first();

        if ($document) {
            $document->delete();

            activity()
                ->performedOn($document)
                ->log('Deleted resource '.$document->name);

            return redirect()->route('dashboard.documents.index')->with('success', 'Se elimino el documento!');
        }

        return redirect()->route('dashboard.documents.show', ['id' => $document->id])->with('error', 'No se pudo eliminar el documento!');
    }
}
