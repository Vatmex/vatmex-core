@extends('dashboard.templates.main')

@section('content')
    <section class="users-view">
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-9">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Editar Categoría </span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <form action="{{ route('dashboard.categories.update', ['id' => $category->id]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Nombre</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="name" class="form-control" placeholder="Nombre del Documento" name="name" value="{{ $category->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="description">Descripción de la categoría</label>
                                    <div class="col-md-9 mx-auto">
                                        <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el documento">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Categoría
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
