@extends('dashboard.templates.main')

@section('title', 'Lista de Roles');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Roles</li>
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
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th>usuarios</th>
                                        <th>acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td><a href="{{ route('dashboard.roles.show', ['id' => $role->id]) }}">{{ $role->name }}</a></td>
                                            <td>{{ \App\Models\User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();  }}</td>
                                            <td><a href="#">ver</a> @can('edit roles') | <a href="{{ route('dashboard.roles.edit', ['id' => $role->id]) }}">editar</a>@endcan</td>
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
