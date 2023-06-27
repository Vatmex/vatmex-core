@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-9">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Editar Equipo de Trabajo </span></h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Equipo</button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Borrar Equipo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas borrar este equipo?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ url('ops/site/teams') }}/{{ $team->id }}/delete" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Borrar Evento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card details start -->
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <form action="{{ url('/ops/site/teams') }}/{{ $team->id }}/edit" method="post" class="form form-horizontal">
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
        <!-- users view card details ends -->
    </section>
@endsection

@section('page-js')
    <script>
        document.getElementById("modal-button").addEventListener("click", function(event){
            event.preventDefault()
        });
    </script>
@endsection
