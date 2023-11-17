@extends('dashboard.templates.main')

@section('title', 'Editar Rol');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.show', ['id' => $role->id]) }}">{{ $role->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <section class="users-view">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <form action="{{ route('dashboard.roles.update', ['id' => $role->id]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <h5 class="mb-1"><i class="ft-link"></i>General</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td class="users-view-username">{{ $role->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Generales</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="access dashboard">Ver Dashboard</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="access dashboard" name="access dashboard" {{ ($role->hasPermissionTo('access dashboard')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Usuarios</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view users">Ver Usuarios</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view users" name="view users" {{ ($role->hasPermissionTo('view users')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Roles</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view roles">Ver Roles</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view roles" name="view roles" {{ ($role->hasPermissionTo('view roles')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="create roles">Crear Roles</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="create roles" name="create roles" {{ ($role->hasPermissionTo('create roles')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit roles">Editar Roles</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit roles" name="edit roles" {{ ($role->hasPermissionTo('edit roles')) ? 'checked' : '' }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="assign roles">Asignar Roles</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="assign roles" name="assign roles" {{ ($role->hasPermissionTo('assign roles')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="remove roles">Remover Roles</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="remove roles" name="remove roles" {{ ($role->hasPermissionTo('remove roles')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="delete roles">Eliminar Roles</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="delete roles" name="delete roles" {{ ($role->hasPermissionTo('delete roles')) ? 'checked' : '' }} >
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Staff</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view staff">Ver Staff</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view staff" name="view staff" {{ ($role->hasPermissionTo('view staff')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="create staff">Crear Staff</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="create staff" name="create staff" {{ ($role->hasPermissionTo('create staff')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit staff">Editar Staff</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit staff" name="edit staff" {{ ($role->hasPermissionTo('edit staff')) ? 'checked' : '' }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="assign staff">Asignar Staff</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="assign staff" name="assign staff" {{ ($role->hasPermissionTo('assign staff')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="delete staff">Eliminar Staff</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="delete staff" name="delete staff" {{ ($role->hasPermissionTo('delete staff')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Recursos</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view documents">Ver Recursos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view documents" name="view documents" {{ ($role->hasPermissionTo('view documents')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="create documents">Crear Recursos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="create documents" name="create documents" {{ ($role->hasPermissionTo('create documents')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit documents">Editar Recursos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit documents" name="edit documents" {{ ($role->hasPermissionTo('edit documents')) ? 'checked' : '' }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="delete documents">Eliminar Recursos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="delete documents" name="delete documents" {{ ($role->hasPermissionTo('delete documents')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Solicitudes ATC</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view applications">Ver Solicitudes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view applications" name="view applications" {{ ($role->hasPermissionTo('view applications')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="assign applications">Asignar Solicitudes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="assign applications" name="assign applications" {{ ($role->hasPermissionTo('assign applications')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Instructores</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view instructors">Ver Instructores</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view instructors" name="view instructors" {{ ($role->hasPermissionTo('view instructors')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="create instructors">Crear Instructores</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="create instructors" name="create instructors" {{ ($role->hasPermissionTo('create instructors')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit instructors">Editar Instructores</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit instructors" name="edit instructors" {{ ($role->hasPermissionTo('edit instructors')) ? 'checked' : '' }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="delete instructors">Eliminar Instructores</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="delete instructors" name="delete instructors" {{ ($role->hasPermissionTo('delete instructors')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Estudiantes</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view students">Ver Estudiantes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view students" name="view students" {{ ($role->hasPermissionTo('view students')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit students">Editar Estudiantes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit students" name="edit students" {{ ($role->hasPermissionTo('edit students')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="assign students">Asignar Estudiantes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="assign students" name="assign students" {{ ($role->hasPermissionTo('assign students')) ? 'checked' : '' }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="remove students">Remover Estudiantes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="remove students" name="remove students" {{ ($role->hasPermissionTo('remove students')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos ATCs</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view atcs">Ver ATCs</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view atcs" name="view atcs" {{ ($role->hasPermissionTo('view atcs')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit atcs">Editar ATCs</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit atcs" name="edit atcs" {{ ($role->hasPermissionTo('edit atcs')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Eventos</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view events">Ver Eventos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view events" name="view events" {{ ($role->hasPermissionTo('view events')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="create events">Crear Eventos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="create events" name="create events" {{ ($role->hasPermissionTo('create events')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="edit events">Editar Eventos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="edit events" name="edit events" {{ ($role->hasPermissionTo('edit events')) ? 'checked' : '' }} >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="delete events">Eliminar Eventos</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="delete events" name="delete events" {{ ($role->hasPermissionTo('delete events')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> Permisos Auditoria</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="view logs">Ver Logs</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view logs" name="view logs" {{ ($role->hasPermissionTo('view logs')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="view records">Ver Expedientes</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="view records" name="view records" {{ ($role->hasPermissionTo('view records')) ? 'checked' : '' }} >
                                    </div>

                                    <label class="col-md-3 label-control" for=""></label>
                                    <div class="col-md-1 mx-auto">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Rol
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
