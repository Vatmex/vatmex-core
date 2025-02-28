@extends('dashboard.templates.main')

@section('title', 'Roster Estudiantes');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Estudiantes</li>
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
                                        <th>rating</th>
                                        <th>instructor</th>
                                        <th>última sesión</th>
                                        <th>próxima sesión</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->user->cid }}</td>
                                            <td><a href="{{ route('dashboard.students.show', ['cid' => $student->user->cid]) }}">{{ $student->user->name }}</a></td>
                                            <td><x-rank :rank="$student->rank" /></td>
                                            <td><a href="{{ route('dashboard.instructors.show', ['cid' => $student->instructor->user->cid]) }}">{{ $student->instructor->user->name }}</a></td>
                                            <td>TODO</td>
                                            <td>TODO</td>
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
