@extends('dashboard.templates.main')

@section('title', 'Detalle Nota de Entrenamiento')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.index') }}">Estudiantes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.show', ['cid' => $note->student->user->cid]) }}">{{ $note->student->user->name }}</a></li>
        <li class="breadcrumb-item active">Nota</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    @if (\Auth::user()->cid == $note->created_by)
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <a href="{{ route('dashboard.trainingNotes.edit', ['id' => $note->id]) }}" class="btn btn-block btn-primary glow">Editar Nota</a>
        </div>
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Nota</button>
        </div>
    @else
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
    @endif
@endsection

@section('content')
    <section class="users-view">
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Borrar Nota</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas borrar esta Nota?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.trainingNotes.delete', ['id' => $note->id]) }}" method="post">
                            @csrf
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-danger">Borrar Nota</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card details start -->
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $note->student->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $note->student->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Creada por:</td>
                                    <td class="users-view-email">{{ (\App\Models\User::where('cid', $note->created_by))->first()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Creada el:</td>
                                    <td class="users-view-email">{{ $note->created_at->isoFormat('LLLL') }}</td>
                                </tr>
                                <tr>
                                    <td>Mensaje:</td>
                                    <td class="users-view-email">{!! $note->message !!}</td>
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
