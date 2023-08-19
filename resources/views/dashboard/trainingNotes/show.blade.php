@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Nota de Entrenamiento</span></h4>
                    </div>
                </div>
            </div>
            @if (\Auth::user()->cid == $note->created_by)
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <a href="{{ route('dashboard.trainingNotes.edit', ['id' => $note->id]) }}" class="btn btn-block btn-primary glow">Editar Nota</a>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                    <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Nota</button>
                </div>
            @endif
        </div>
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
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('dashboard.trainingNotes.delete', ['id' => $note->id]) }}" method="post">
                            @csrf
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
