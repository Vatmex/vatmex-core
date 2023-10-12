@extends('dashboard.templates.main')

@section('title', 'Detalle Instructor');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.instructors.index')}}">Instructores</a></li>
        <li class="breadcrumb-item active">{{ $instructor->user->name }}</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    @can('edit instructors')
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <a href="{{ route('dashboard.instructors.edit', ['cid' => $instructor->user->cid]) }}" class="btn btn-block btn-primary glow">Editar Instructor</a>
        </div>
    @else
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
    @endcan
    @can('delete instructors')
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Eliminar Instructor</button>
        </div>
    @else
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
    @endcan
@endsection

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Eliminar Instructor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas eliminar el perfil de instructor de {{ $instructor->user->name }}?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.instructors.delete', ['cid' => $instructor->user->cid])}}" method="post">
                            @csrf
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-danger">Eliminar Instructor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $instructor->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $instructor->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="users-view-name">
                                        @if ($instructor->user->staff)
                                            {{ $instructor->user->staff->email }}
                                        @else
                                            {{ $instructor->user->email }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Instructor Desde:</td>
                                    <td class="users-view-email">{{ $instructor->created_at->isoFormat('LLLL') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Estadísticas</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Estudiantes activos:</td>
                                    <td class="users-view-email">{{ $instructor->atcs->where('is_training', true)->count() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Habilitaciones</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Torre:</td>
                                    <td class="users-view-email">{{ ($instructor->tower) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Terminal</td>
                                    <td class="users-view-email">{{ ($instructor->approach) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Enruta</td>
                                    <td class="users-view-email">{{ ($instructor->center) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Estudiantes</h5>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>cid</th>
                                        <th>nombre</th>
                                        <th>rating</th>
                                        <th>ultima sesión</th>
                                        <th>desasignar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($instructor->atcs->where('is_training', true) as $atc)
                                        <tr>
                                            <td>{{ $atc->user->cid }}</td>
                                            <td><a href="{{ route('dashboard.students.show', ['cid' => $atc->user->cid]) }}">{{ $atc->user->name }}</a></td>
                                            <td><x-rank :rank="$atc->rank"/></td>
                                            <td>TODO</td>
                                            <td><a href="#">TODO</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
