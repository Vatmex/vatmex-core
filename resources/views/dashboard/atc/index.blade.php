@extends('dashboard.templates.main')

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">
            <form>
                <div class="row py-2 mb-2">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <h3>Roster ATC</h3>
                    </div>
                </div>
            </form>
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <x-dashboard.alerts/>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>cid</th>
                                        <th>nombre</th>
                                        <th>iniciales</th>
                                        <th>estatus</th>
                                        <th>rango</th>
                                        <th>horas mes</th>
                                        <th>horas totales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($atcs as $atc)
                                        <tr>
                                            <td><a href="{{ route('dashboard.atcs.show', ['cid' => $atc->user->cid]) }}">{{ $atc->user->cid }}</a></td>
                                            <td>{{ $atc->user->name }}</td>
                                            <td>{{ $atc->initials }}</td>
                                            <td>{!! ($atc->inactive) ? '<span class="badge badge-danger">inactivo</span>' : '<span class="badge badge-success">activo</span>';!!}</td>
                                            <td><x-rank :rank="$atc->rank"/></td>
                                            <td>No Implementado</td>
                                            <td>No Implementado</td>
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
    <!-- users list ends -->
@endsection

@section('page-js')
    <script>
        $(document).ready(function () {
            $('#users-list-datatable').DataTable();
        });
    </script>
@endsection
