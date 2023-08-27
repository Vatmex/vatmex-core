@extends('dashboard.templates.main')

@section('title', 'Editar Instructor');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.instructors.index')}}">Instructores</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.instructors.show', ['cid' => $instructor->user->cid]) }}">{{ $instructor->user->name }}</a></li>
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
