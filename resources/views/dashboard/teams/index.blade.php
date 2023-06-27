@extends('dashboard.templates.main')

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">
            <form>
                <div class="row py-2 mb-2">
                    <div class="col-12 col-sm-12 col-lg-9">
                        <h3>Lista de Equipos de Trabajo</h3>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 d-flex align-items-center">
                        <a href="{{ url('ops/site/teams/new') }}" class="btn btn-block btn-primary glow">Nuevo Equipo</a>
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
                        @if(!$teams->isEmpty())
                            <div class="table-responsive">
                                <table id="users-list-datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>miembros</th>
                                            <th>creado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                            <tr>
                                                <td><a href="{{ url('ops/site/teams') }}/{{ $team->id }}">{{ $team->id }}</a></td>
                                                <td>{{ $team->name }}</td>
                                                <td>{{ $team->staff->count() }}</td>
                                                <td>{{ $team->created_at->toDateTimeString() }}</td>
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
