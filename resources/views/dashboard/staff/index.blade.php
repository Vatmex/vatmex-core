@extends('dashboard.templates.main')

@section('title', 'Lista de Posiciones Staff');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Staff</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-12 col-sm-12 col-lg-2 d-flex align-items-center">
        <a href="{{ route('dashboard.staff.create') }}" class="btn btn-block btn-primary glow">Nueva Posición</a>
    </div>
@endsection

@section('content')
    <section class="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <x-dashboard.alerts/>
                        <!-- datatable start -->
                        @if(!$staffs->isEmpty())
                            <div class="table-responsive">
                                <table id="users-list-datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>asignado a</th>
                                            <th>equipo  </th>
                                            <th>creado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($staffs as $staff)
                                            <tr>
                                                <td><a href="{{ route('dashboard.staff.show', ['id' => $staff->id]) }}">{{ $staff->id }}</a></td>
                                                <td>{{ $staff->position }}</td>
                                                <td>{{ ($staff->user) ? $staff->user->name : 'Vacante' }}</td>
                                                <td>{{ ($staff->team) ? $staff->team->name : 'Sin Equipo' }}</td>
                                                <td>{{ $staff->created_at->toDateTimeString() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4 style="text-align: center;">No hay posiciones de Staff en este momento</h4>
                        @endif
                        <!-- datatable ends -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- users list ends -->
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
