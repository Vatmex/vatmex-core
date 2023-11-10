@extends('dashboard.templates.main')

@section('title', 'Editar Controlador');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.atcs.index') }}">Controladores</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.atcs.show', ['cid' => $atc->user->cid]) }}">{{ $atc->user->name }}</a></li>
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
                        <div class="col-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td class="users-view-username">{{ $atc->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>CID:</td>
                                        <td class="users-view-name">{{ $atc->user->cid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rango:</td>
                                        <td class="users-view-email"><x-rank :rank="$atc->rank"/></td>
                                    </tr>
                                    <tr>
                                        <td>Estatus:</td>
                                        <td class="users-view-email">{{ ($atc->inactive ? 'Inactivo' : 'Activo') }}</td>
                                    </tr>
                                    <tr>
                                        <td>CTA Desde:</td>
                                        <td class="users-view-email">{{ $atc->created_at->isoFormat('LLLL') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('dashboard.atcs.update', ['cid' => $atc->user->cid]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Nombre</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="name" class="form-control" placeholder="Nombre del Documento" name="name" value="{{ $atc->user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="initials">Iniciales</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="initials" class="form-control" placeholder="Nombre del Documento" name="initials" value="{{ $atc->initials }}">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Habilitaciones</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="delivery">Autorizaciones</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="delivery" name="delivery" {{ ($atc->delivery) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="ground">Terrestre</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="ground" name="ground" {{ ($atc->ground) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="tower">Torre</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="tower" name="tower" {{ ($atc->tower) ? 'checked' : ''; }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="approach">Aproximación</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="approach" name="approach" {{ ($atc->approach) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="center">Centro</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="center" name="center" {{ ($atc->center) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="supercenter">Supercentro</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="supercenter" name="supercenter" {{ ($atc->supercenter) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Controlador
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
