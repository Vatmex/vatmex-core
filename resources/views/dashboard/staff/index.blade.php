@extends('dashboard.templates.main')

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">
            <form>
                <div class="row py-2 mb-2">
                    <div class="col-12 col-sm-12 col-lg-9">
                        <h3>Lista de Posiciones Staff</h3>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 d-flex align-items-center">
                        <a href="{{ url('ops/site/staff/new') }}" class="btn btn-block btn-primary glow">Nueva Posición</a>
                    </div>
                </div>
            </form>
        </div>
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
                                                <td><a href="{{ url('ops/site/staff') }}/{{ $staff->id }}">{{ $staff->id }}</a></td>
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
            $('#users-list-datatable').DataTable();
        });
    </script>
@endsection
