@extends('dashboard.templates.main')

@section('title', 'Editar Posición Staff');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.staff.index') }}">Staff</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.staff.show', ['id' => $staff->id]) }}">{{ $staff->position }}</a></li>
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
                        <form action="{{ url('/ops/site/staff/' . $staff->id . '/edit') }}" method="post" class="form form-horizontal">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="position">Posición</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="position" class="form-control" placeholder="Puesto de la posición" name="position" value="{{ $staff->position }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="shortcode">Shortcode</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="shortcode" class="form-control" placeholder="Shortcode" name="shortcode" value="{{ $staff->shortcode }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email de Staff</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="email" class="form-control" placeholder="ejemplo@vatmex.com.mx" name="email" value="{{ $staff->email }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="description">Descripción del Puesto</label>
                                    <div class="col-md-9 mx-auto">
                                        <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el puesto">{{ $staff->description }}</textarea>
                                    </div>
                                </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Posición
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
