@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-9">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Estudiante</span></h4>
                    </div>
                </div>
            </div>
            @can('remove students')
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Desactivar Estudiante</button>
                </div>
            @else
                <div class="col-12 col-sm-12 col-lg-3 align-items-center"></div>
            @endcan
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
                                    <td class="users-view-name"><a href="{{ route('dashboard.instructors.show', ['id' => $student->instructor->id]) }}">{{ $student->instructor->user->name }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Notas Entrenamiento</h5>
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
                                    <tr>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5 class="mb-1"><i class="ft-link"></i>Sesiones Entrenamiento</h5>
                        <div class="table-responsive">
                            <table id="users-list-2-datatable" class="table">
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
                                    <tr>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                    </tr>
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
        $(document).ready(function () {
            $('#users-list-2-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
            });
        });
    </script>
@endsection
