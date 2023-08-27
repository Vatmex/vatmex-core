@extends('dashboard.templates.main')

@section('title', 'Roster ATC');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Controladores</li>
    </ol>
@endsection

@section('content')
    <section class="users-list-wrapper">
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
                                        <th>horas este mes</th>
                                        <th>horas mes anterior</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($atcs as $atc)
                                        <tr>
                                            <td>{{ $atc->user->cid }}</td>
                                            <td><a href="{{ route('dashboard.atcs.show', ['cid' => $atc->user->cid]) }}">{{ $atc->user->name }}</a></td>
                                            <td>{{ $atc->initials }}</td>
                                            <td>{!! ($atc->inactive) ? '<span class="badge badge-danger">inactivo</span>' : '<span class="badge badge-success">activo</span>'; !!}</td>
                                            <td><x-rank :rank="$atc->rank"/></td>
                                            <td>{{ $atc->current_month_hours }}</td>
                                            <td>{{ $atc->last_month_hours }}</td>
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
            $('#users-list-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                pageLength: 25,
                columnDefs: [
                    { "type": "num", "targets": [0, 5, 6] },
                    { "type": "html", "targets": 0 }
                ],
            });
        });
    </script>
@endsection
