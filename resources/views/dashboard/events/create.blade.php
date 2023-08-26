@extends('dashboard.templates.main')

@section('title', 'Crear Evento');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.events.index') }}">Eventos</a></li>
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
                                <p>Usa el sigiuente formulario para crear un nuevo evento. Utiliza la casilla de visibilidad si deseas ir creando un evento que aun no se muestre en la página. Si tienes dudas sobre el formulario comunicate con el administrador del la página.</p>
                            </div>
                            <form action="{{ route('dashboard.events.store') }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="name">Nombre</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="name" class="form-control" placeholder="Nombre del Evento" name="name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="slug">Slug</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="slug" class="form-control" placeholder="Nombre del Evento" name="slug">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Descripción del Evento</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el evento"></textarea>
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-clipboard"></i> Información Vatsim</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="departure_airfields">Aerodromos Salida:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="departure_airfields" class="form-control" placeholder="ej. MMMX" name="departure_airfields">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="arrival_airfields">Aerodromos Llegada:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="arrival_airfields" class="form-control" placeholder="ej MMGL" name="arrival_airfields">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="start">Horario Inicio:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="datetime-local" class="form-control" name="start" id="start" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="end">Horario Fin:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="datetime-local" class="form-control" name="end" id="end" value="">
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-clipboard"></i> Marketing</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Banner</label>
                                        <div class="col-md-9 mx-auto">
                                            <label class="file center-block">
                                                <input type="file" name="banner" id="banner">
                                                <span class="file-custom"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="hidden">Visibilidad</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="checkbox" id="hidden" name="hidden" value="1"> Ocultar Evento
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Crear Evento
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
