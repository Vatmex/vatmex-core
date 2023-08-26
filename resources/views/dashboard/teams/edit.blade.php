@extends('dashboard.templates.main')

@section('title', 'Editar Equipo de Trabajo');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.teams.index')}}">Equipos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.teams.show', ['id' => $team->id]) }}">{{ $team->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-12 col-sm-12 col-lg-2 align-items-center">
        <a href="{{ route('dashboard.teams.update', ['id' => $team->id]) }}" class="btn btn-block btn-primary glow">Editar Equipo</a>
    </div>
    <div class="col-12 col-sm-12 col-lg-2 align-items-center">
        <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Equipo</button>
    </div>
@endsection

@section('content')
    <section class="users-view">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <form action="{{ route('dashboard.teams.store', ['id' => $team->id]) }}" method="post" class="form form-horizontal">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Nombre</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="name" class="form-control" placeholder="Nombre del Evento" name="name" value="{{ $team->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="description">Descripción del Equipo</label>
                                    <div class="col-md-9 mx-auto">
                                        <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el equipo">{{ $team->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Actualizar Equipo
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
