<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function show(int $id)
    {
        if (\Auth::user()->hasPermissionTo('view trashed')) {
            $category = Category::withTrashed()->where('id', $id)->firstOrFail();

            if($category->trashed()) {
                \Session::flash('error','Estas viendo un registro que fue borrado. Esta almacenado para motivos de auditoría y solo puede ser visto por administradores.');
            }
        }
        else {
            $category = Category::where('id', $id)->firstOrFail();
        }
        return view('dashboard.categories.show', compact('category'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        activity()
            ->performedOn($category)->withProperties([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ])->log('Created resource category '.$category->name);

        return redirect()->route('dashboard.categories.show', ['id' => $category->id])->with('success', 'Categoría creada con éxito!');
    }

    public function edit(int $id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $category = Category::where('id', $id)->first();

        if (! $category) {
            return redirect()->route('dashboard.categories.index')->with('error', 'No se pudo editar la categoría!');
        }

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        activity()
            ->performedOn($category)
            ->withProperties([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ])->log('Updated resource category '.$category->name);

        return redirect()->route('dashboard.categories.show', ['id' => $id])->with('success', 'Se actualizo la categoría con éxito!');
    }

    public function destroy(int $id)
    {
        $category = Category::where('id', $id)->first();

        if ($category) {
            $category->delete();

            activity()
                ->performedOn($category)
                ->log('Deleted resource category '.$category->name);

            return redirect()->route('dashboard.categories.index')->with('success', 'Se elimino la categoria!');
        }

        return redirect()->route('dashboard.categories.show', ['id' => $category->id])->with('error', 'No se pudo eliminar la categoria!');
    }
}
