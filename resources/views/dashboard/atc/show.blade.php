@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-3">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Controlador</span></h4>
                    </div>
                </div>
            </div>
            @can('create instructors')
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <a href="{{ route('dashboard.instructors.store', ['cid' => $atc->user->cid]) }}" class="btn btn-block btn-success glow">Promover a Instructor</a>
                </div>
            @else
                <div class="col-12 col-sm-12 col-lg-3 align-items-center"></div>
            @endcan
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <a href="{{ route('dashboard.atcs.edit', ['cid' => $atc->user->cid]) }}" class="btn btn-block btn-primary glow">Editar Controlador</a>
            </div>
            @if ($atc->inactive)
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Reactivar Controlador  </button>
                </div>
                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel1">Activar Controlador</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="text-align: center;">¿Estas seguro de que deseas reactivar este controlador?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <form action="{{ route('dashboard.atcs.activate', ['cid' => $atc->user->cid])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Activar Controlador</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Suspender Controlador  </button>
                </div>
                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel1">Desactivar Controlador</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="text-align: center;">¿Estas seguro de que deseas desactivar este controlador?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <form action="{{ route('dashboard.atcs.deactivate', ['cid' => $atc->user->cid])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Desactivar Controlador</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- users view media object ends -->
        <!-- users view card details start -->
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
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
                                    <td>Iniciales:</td>
                                    <td class="users-view-name">{{ $atc->initials }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="users-view-name">{{ $atc->user->email }}</td>
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
                        <h5 class="mb-1"><i class="ft-link"></i>Estadísticas</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Horas Mes en Curso:</td>
                                    <td class="users-view-email">{{ $atc->current_month_hours }}</td>
                                </tr>
                                <tr>
                                    <td>Horas Mes Anterior:</td>
                                    <td class="users-view-email">{{ $atc->last_month_hours }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Posiciones Autorizadas</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Autorizaciones:</td>
                                    <td class="users-view-username">{{ ($atc->delivery) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Terrester:</td>
                                    <td class="users-view-name">{{ ($atc->ground) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Torre:</td>
                                    <td class="users-view-email">{{ ($atc->tower) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Aproximación</td>
                                    <td class="users-view-email">{{ ($atc->approach) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Centro</td>
                                    <td class="users-view-email">{{ ($atc->center) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Feedback</h5>
                        @can('view feedback')
                            <div class="table-responsive">
                                <table id="users-list-datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>cid</th>
                                            <th>email</th>
                                            <th>rating</th>
                                            <th>actualizado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($atc->feedbacks as $feedback)
                                            <tr>
                                                <td><a href="{{ route('dashboard.feedbacks.show', ['id' => $feedback->id]) }}">{{ $feedback->id }}</a></td>
                                                <td>{{ $feedback->name }}</td>
                                                <td>{{ $feedback->cid }}</td>
                                                <td>{{ $feedback->email }}</td>
                                                <td><x-rating :rating="$feedback->rating"/></td>
                                                <td>{{ $feedback->created_at->toDayDateTimeString() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No tienes permiso para ver el feedback de otros controladores</p>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->
    </section>
@endsection

@section('page-js')
    <script>
        $(document).ready(function () {
            $('#users-list-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
            });
        });
    </script>
@endsection
