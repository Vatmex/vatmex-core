@extends('dashboard.templates.main')

@section('title', 'Visualizar Rol');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">{{ $role->name }}</li>
    </ol>
@endsection

@section('content')
    <section class="users-view">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <h5 class="mb-1"><i class="ft-link"></i>General</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $role->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisios Sitio</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Usuarios:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view users')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Ver Roles:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view roles')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Crear Roles:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('create roles')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar Roles:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit roles')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Asignar Roles:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('assign roles')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Remover Roles:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('remove roles')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Eliminar Roles:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('delete roles')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Staff</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Staff:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view staff')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Crear Staff:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('create staff')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar Staff:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit staff')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Asignar Staff:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('assign staff')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Eliminar Staff:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('delete staff')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Recursos</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Recursos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view documents')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Crear Recursos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('create documents')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar Recursos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit documents')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Eliminar Recursos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('delete documents')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Aplicaciones ATC</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Aplicaciones:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view applications')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Crear Aplicaciones:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('assign applications')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Instructores</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Instructores:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view instructors')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Crear Instructores:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('create instructors')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar Instructores:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit instructors')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Eliminar Instructores:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('delete instructors')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Estudiantes</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Estudiantes:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view students')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar Estudiantes:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit students')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Asignar Estudiantes:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('assign students')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Remover Estudiantes:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('remove students')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos ATC</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver ATCs:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view atcs')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar ATCs:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit atcs')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Eventos</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Eventos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view events')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Crear Eventos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('create events')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Editar Eventos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('edit events')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Eliminar Eventos:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('delete events')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Permisos Auditoria</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Ver Logs:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view logs')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                                <tr>
                                    <td>Ver Expedientes:</td>
                                    <td class="users-view-username">{{ ($role->hasPermissionTo('view records')) ? 'Permitido' : 'No Permitido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->
    </section>
@endsection
