@extends('dashboard.templates.main')

@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Crear Nuevo Staff</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para crear un nuevo equipo de trabajo. Si el email de staff queda vació se tomara el email del usuario asignado.  Si tienes dudas sobre el formulario comunicate con el administrador del la página.</p>
                            </div>
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
        </div>
    </section>
@endsection
