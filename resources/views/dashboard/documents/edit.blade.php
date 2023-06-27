@extends('dashboard.templates.main')

@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Editar Documento</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para crear un nuevo evento. Utiliza la casilla de visibilidad si deseas ir creando un evento que aun no se muestre en la página. Si tienes dudas sobre el formulario comunicate con el administrador del la página.</p>
                            </div>
                            <form action="{{ route('dashboard.documents.update', ['id' => $document->id]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="name">Nombre</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="name" class="form-control" placeholder="Nombre del Documento" name="name" value="{{ $document->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="version">Versión</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="version" class="form-control" placeholder="Version del Documento" name="version" value="{{ $document->version }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Descripción del Documento</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el documento">{{ $document->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="category">Categoria</label>
                                        <div class="col-md-9 mx-auto">
                                            <select id="category" class="form-control" name="category" selected="{{ $document->category }}">
                                                @foreach ($categories as $category)
                                                    <option>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Documento (PDF)</label>
                                        <div class="col-md-9 mx-auto">
                                            <label class="file center-block">
                                                <input type="file" name="document" id="document">
                                                <span class="file-custom"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Editar Documento
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
