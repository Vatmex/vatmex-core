@extends('dashboard.templates.main')

@section('title', 'Editar Categoría');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categorías</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.show', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <section class="users-view">
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
