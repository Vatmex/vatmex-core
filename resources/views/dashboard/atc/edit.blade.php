@extends('dashboard.templates.main')

@section('content')
    <section id="horizontal-form-layouts" class="users-view">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Editar Controlador</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para editar las habilitaciones de un controlador. Recuerda que los rangos se actualizan automáticamente de Vatsim cada hora y no pueden ser modificados manualmente.</p>
                            </div>
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
                                            <td class="users-view-email">{{ $atc->created_at->toDayDateTimeString() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form action="{{ route('dashboard.atcs.update', ['cid' => $atc->user->cid]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
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
        </div>
    </section>
@endsection
