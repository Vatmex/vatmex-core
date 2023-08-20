@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Sessión de Entrenamiento</span></h4>
                    </div>
                </div>
            </div>
            @if (\Auth::user()->cid == $session->created_by && $session->canceled != true)
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <a href="{{ route('dashboard.trainingSessions.edit', ['id' => $session->id]) }}" class="btn btn-block btn-primary glow">Editar Sesión</a>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <a href="{{ route('dashboard.trainingSessions.cancel', ['id' => $session->id]) }}" class="btn btn-block btn-danger glow">Cancelar Sesión</a>
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
                        @if($session->canceled)
                            <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Esta sesión fue cancelada
                            </div>
                        @endif
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Título:</td>
                                    <td class="users-view-username">{{ $session->title }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $session->student->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $session->student->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha sesión:</td>
                                    <td class="users-view-email">{{ Carbon\Carbon::parse($session->scheduled_time, 'UTC')->setTimezone('America/Mexico_City')->isoFormat('LLLL') }}</td>
                                </tr>
                                <tr>
                                    <td>Creada por:</td>
                                    <td class="users-view-email">{{ (\App\Models\User::where('cid', $session->created_by))->first()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Creada el:</td>
                                    <td class="users-view-email">{{ $session->created_at->isoFormat('LLLL') }}</td>
                                </tr>
                                <tr>
                                    <td>Objetivo:</td>
                                    <td class="users-view-email">{!! $session->description !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if($session->canceled)
                            <table class="table table-borderless">
                                <tbody>
                                    <h4 class="form-section"><i class="ft-user"></i> Información cancelación</h4>
                                    <tr>
                                        <td>Cancelada el:</td>
                                        <td class="users-view-email">{{ Carbon\Carbon::parse($session->cancelation_time, 'UTC')->setTimezone('America/Mexico_City')->isoFormat('LLLL') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Motivo cancelación:</td>
                                        <td class="users-view-email">{!! $session->cancelation_motive !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->
    </section>
@endsection
