@extends('dashboard.templates.main')

@section('title', 'Crear Nuevo Equipo');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.teams.index')}}">Equipos</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
@endsection

@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para crear un nuevo equipo de trabajo.  Si tienes dudas sobre el formulario comunicate con el administrador del la página.</p>
                            </div>
                            <form action="{{ url('/ops/site/teams/new') }}" method="post" class="form form-horizontal">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="name">Nombre</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="name" class="form-control" placeholder="Nombre del Equipo" name="name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Descripción del Equipo</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el equipo"></textarea>
                                        </div>
                                    </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Crear Equipo
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
