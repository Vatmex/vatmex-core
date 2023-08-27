@extends('dashboard.templates.main')

@section('title', 'Detalle Estudiante');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.index')}}">Estudiantes</a></li>
        <li class="breadcrumb-item active">{{ $student->user->name }}</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    @can('remove students')
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Desactivar Estudiante</button>
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
                        <h4 class="modal-title" id="myModalLabel1">Desactivar Estudiante</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas detener la instrucción de {{ $student->user->name }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('dashboard.students.remove', ['cid' => $student->user->cid])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Desactivar Estudiante</button>
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
                                    <td class="users-view-username">{{ $student->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $student->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="users-view-name">{{ $student->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Instructor:</td>
                                    <td class="users-view-name"><a href="{{ route('dashboard.instructors.show', ['cid' => $student->instructor->user->cid]) }}">{{ $student->instructor->user->name }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Notas Entrenamiento</h5>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>fecha</th>
                                        <th>autor</th>
                                        <th>visibilidad</th>
                                        <th>acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->notes as $note)
                                        <tr>
                                            <td>{{ $note->id }}</td>
                                            <td>{{ $note->created_at->isoFormat('LLLL') }}</td>
                                            <td><a href="{{ route('dashboard.instructors.show', ['cid' => \App\Models\User::where('cid', $note->created_by)->first()->cid]) }}">{{ \App\Models\User::where('cid', $note->created_by)->first()->name }}</td>
                                            <td>{{ ($note->visible_to_student) ? 'alumno' : 'instructores' }}</td>
                                            <td><a href="{{ route('dashboard.trainingNotes.show', ['id' => $note->id]) }}">ver</a>  @if(\Auth::user()->cid == $note->created_by) | <a href="{{ route('dashboard.trainingNotes.edit', ['id' => $note->id]) }}">editar</a> @endif</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5 class="mb-1"><i class="ft-link"></i>Sesiones Entrenamiento</h5>
                        <div class="table-responsive">
                            <table id="users-list-2-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>fecha</th>
                                        <th>título</th>
                                        <th>instructor</th>
                                        <th>estatus</th>
                                        <th>acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->sessions as $session)
                                        <tr>
                                            <td>{{ $session->id }}</th>
                                            <!-- TODO: Allow for user selected timezones  -->
                                            <td>{{ Carbon\Carbon::parse($session->scheduled_time, 'UTC')->setTimezone('America/Mexico_City')->isoFormat('LLLL') }}</th>
                                            <td>{{ $session->title }}</th>
                                            <td><a href="{{ route('dashboard.instructors.show', ['cid' => \App\Models\User::where('cid', $note->created_by)->first()->cid]) }}">{{ \App\Models\User::where('cid', $session->created_by)->first()->name }}</a></th>
                                            <td>{!! ($session->canceled) ? '<span class="badge badge-danger">cancelada</span>' : '<span class="badge badge-success">normal</span>'; !!}</td>
                                            <td><a href="{{ route('dashboard.trainingSessions.show', ['id' => $session->id]) }}">ver</a> @if(\Auth::user()->cid == $session->created_by && $session->canceled != true) |  <a href="{{ route('dashboard.trainingSessions.edit', ['id' => $session->id]) }}">editar</a> @endif</th>
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
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nueva Nota',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "{{ route('dashboard.trainingNotes.create', ['cid' => $student->user->cid]) }}";
                        }
                    }
                ]
            });
        });

        $(document).ready(function () {
            $('#users-list-2-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nueva Sesión',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "{{ route('dashboard.trainingSessions.create', ['cid' => $student->user->cid]) }}";
                        }
                    }
                ]
            });
        });
    </script>
@endsection
