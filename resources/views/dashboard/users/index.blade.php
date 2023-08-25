@extends('dashboard.templates.main')

@section('title', 'Lista de Usuarios');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
@endsection

@section('content')
    <section class="users-view">
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
                                        <th>email</th>
                                        <th>roles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->cid }}</td>
                                            <td><a href="{{ route('dashboard.users.show', ['cid' => $user->cid]) }}">{{ $user->name }}</a></td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <a class="badge badge-info" href="#">{{ $role->name; }}</a>
                                                @endforeach
                                            </td>
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
                    { "type": "num", "targets": [0] },
                ],
            });
        });
    </script>
@endsection
