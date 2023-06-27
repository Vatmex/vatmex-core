@extends('dashboard.templates.main')

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">
            <form>
                <div class="row border border-light rounded py-2 mb-2">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-verified">Verified</label>
                        <fieldset class="form-group">
                            <select class="form-control" id="users-list-verified">
                                <option value="">Any</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-role">Role</label>
                        <fieldset class="form-group">
                            <select class="form-control" id="users-list-role">
                                <option value="">Any</option>
                                <option value="User">User</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-status">Status</label>
                        <fieldset class="form-group">
                            <select class="form-control" id="users-list-status">
                                <option value="">Any</option>
                                <option value="Active">Active</option>
                                <option value="Close">Close</option>
                                <option value="Banned">Banned</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                        <button class="btn btn-block btn-primary glow">Show</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <!-- datatable start -->
                        @if(!$applications->isEmpty())
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>cid</th>
                                        <th>nombre</th>
                                        <th>apellido</th>
                                        <th>fecha</th>
                                        <th>estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td><a href="{{ route('dashboard.applications.show', ['id' => $application->id]) }}">{{ $application->id }}</a></td>
                                            <td>{{ $application->user->cid }}</a></td>
                                            <td>{{ $application->user->first_name }}</td>
                                            <td>{{ $application->user->last_name }}</td>
                                            <td>{{ $application->created_at->toDayDateTimeString() }}</td>
                                            <td>{!! ($application->processed) ? '<span class="badge badge-success">procesada</span>' : '<span class="badge badge-danger">pendiente</span>' !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <h4 style="text-align: center;">No hay aplicaciones CTA en este momento</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script>
        $(document).ready(function () {
            $('#users-list-datatable').DataTable();
        });
    </script>
@endsection

