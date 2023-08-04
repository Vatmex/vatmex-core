@extends('dashboard.templates.main')

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">
            <form>
                <div class="row py-2 mb-2">
                    <div class="col-12 col-sm-12 col-lg-9">
                        <h3>Solicitudes de Entrenamiento CTA</h3>
                    </div>
                </div>
            </form>
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <!-- datatable start -->
                        @if(!$applications->isEmpty())
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>cid</th>
                                        <th>nombre</th>
                                        <th>apellido</th>
                                        <th>fecha</th>
                                        <th>estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td><a href="{{ route('dashboard.applications.show', ['id' => $application->id]) }}">{{ $application->id }}</a></td>
                                            <td>{{ $application->user->cid }}</a></td>
                                            <td>{{ $application->user->first_name }}</td>
                                            <td>{{ $application->user->last_name }}</td>
                                            <td>{{ $application->created_at->toDayDateTimeString() }}</td>
                                            <td>{!! ($application->processed) ? '<span class="badge badge-success">procesada</span>' : '<span class="badge badge-danger">pendiente</span>' !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <h4 style="text-align: center;">No hay aplicaciones CTA en este momento</h4>
                        @endif
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
                order: [0,"desc"],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
            });
        });
    </script>
@endsection
