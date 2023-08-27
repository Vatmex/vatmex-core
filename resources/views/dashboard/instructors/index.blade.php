@extends('dashboard.templates.main')

@section('title', 'Roster Instructores');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Instructores</li>
    </ol>
@endsection

@section('content')
    <!-- users list start -->
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
                                        <th>estudiantes activos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($instructors as $instructor)
                                        <tr>
                                            <td>{{ $instructor->user->cid }}</td>
                                            <td><a href="{{ route('dashboard.instructors.show', ['cid' => $instructor->user->cid]) }}">{{ $instructor->user->name }}</a></td>
                                            <td>{{ $instructor->atcs->where('is_training', true)->count() }}</td>
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
                columnDefs: [
                    { "type": "num", "targets": [0] },
                ],
            });
        });
    </script>
@endsection
