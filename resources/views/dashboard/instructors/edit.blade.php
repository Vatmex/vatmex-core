@extends('dashboard.templates.main')

@section('content')
    <section class="users-view">
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-9">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Editar Instructor</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <div class="col-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td class="users-view-username">{{ $instructor->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>CID:</td>
                                        <td class="users-view-name">{{ $instructor->user->cid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td class="users-view-name">
                                            @if ($instructor->user->staff)
                                                {{ $instructor->user->staff->email }}
                                            @else
                                                {{ $instructor->user->email }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Instructor Desde:</td>
                                        <td class="users-view-email">{{ $instructor->created_at->isoFormat('LLLL') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('dashboard.instructors.update', ['cid' => $instructor->user->cid]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                                <h4 class="form-section"><i class="ft-user"></i> Habilitaciones</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="tower">Torre</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="tower" name="tower" {{ ($instructor->tower) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="approach">Terminal</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="approach" name="approach" {{ ($instructor->approach) ? 'checked' : ''; }} >
                                    </div>

                                    <label class="col-md-3 label-control" for="center">Enruta</label>
                                    <div class="col-md-1 mx-auto">
                                        <input type="checkbox" id="center" name="center" {{ ($instructor->center) ? 'checked' : ''; }} >
                                    </div>
                                </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Instructor
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
