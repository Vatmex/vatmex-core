@extends('dashboard.templates.main')

@section('title', 'Solicitudes de Entrenamiento');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Solicitudes</li>
    </ol>
@endsection

@section('content')
    <section class="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
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
