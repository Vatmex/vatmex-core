@extends('dashboard.templates.main')

@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Editar Evento</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para actualizar la información del evento. Si dejas el baner vació se conservara el banner anterior del evento. Adicionalmente puedes eliminar el evento.</p>
                            </div>
                            <form action="{{ url('/ops/events/') }}/{{ $event->slug }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="name">Nombre</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="name" class="form-control" placeholder="Nombre del Evento" name="name" value="{{ $event->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="slug">Slug</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="slug" class="form-control" placeholder="Nombre del Evento" name="slug" value="{{ $event->slug }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Descripción del Evento</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el evento">{{ $event->description }}</textarea>
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-clipboard"></i> Información Vatsim</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="departure_airfield">Aerodromos Salida:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="departure_airfield" class="form-control" placeholder="ej. MMMX" name="departure_airfields" value="{{ $event->departure_airfields }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="arrival_airfields">Aerodromos Llegada:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="arrival_airfields" class="form-control" placeholder="ej MMGL" name="arrival_airfields" value="{{ $event->arrival_airfields }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="start">Horario Inicio:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="datetime-local" class="form-control" name="start" id="start" value="{{ $event->start }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="end">Horario Fin:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="datetime-local" class="form-control" name="end" id="end" value="{{ $event->end }}">
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-clipboard"></i> Marketing</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Banner Actual</label>
                                        <div class="col-md-9 mx-auto">
                                            <p><a href="#">/storage/{{ $event->banner_path}}</a></p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Nuevo Banner</label>
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
                                            <input type="checkbox" id="hidden" name="hidden" {{ ($event->hidden == true) ? 'checked' : ''; }} > Ocultar Evento
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Actualizar Evento
                                    </button>

                                    <button class="btn btn-danger" id="modal-button" data-toggle="modal" data-target="#default">
                                        <i class="la la-check-square-o"></i> Cancelar Evento
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Borrar evento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align: center;">¿Estas seguro de que deseas borrar este evento?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ url('/ops/events/') }}/{{ $event->id }}/delete" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">Borrar Evento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        document.getElementById("modal-button").addEventListener("click", function(event){
            event.preventDefault()
        });
    </script>
@endsection
