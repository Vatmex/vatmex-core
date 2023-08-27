@extends('dashboard.templates.main')

@section('title', 'Detalle Recurso');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.documents.index') }}">Recursos</a></li>
        <li class="breadcrumb-item active">{{ $document->name }}</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center">
        <a href="{{ route('dashboard.documents.edit', ['id' => $document->id]) }}" class="btn btn-block btn-primary glow">Editar Recurso</a>
    </div>
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center">
        <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Recurso  </button>
    </div>
@endsection

@section('content')
    <section class="users-view">
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Borrar Recurso</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas borrar este recurso?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.documents.delete', ['id' => $document->id]) }}" method="post">
                            @csrf
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-danger">Borrar recurso</button>
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
                                    <td class="users-view-username">{{ $document->name }}</td>
                                </tr>
                                <tr>
                                    <td>Versión:</td>
                                    <td class="users-view-name">{{ $document->version }}</td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td class="users-view-email">{{ $document->description }}</td>
                                </tr>
                                <tr>
                                    <td>Categoría</td>
                                    <td class="users-view-email"><a href="{{ route('dashboard.categories.show', ['id' => $document->category->id]) }}">{{ $document->category->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Actualizado</td>
                                    <td class="users-view-email">{{ $document->updated_at->toDayDateTimeString() }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td class="users-view-email">{{ $document->created_at->toDayDateTimeString() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Archivo</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Archivo:</td>
                                    <td class="users-view-username"><a href="{{ url('/storage/' . $document->document_path) }}">{{ $document->document_path }}</a></td>
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
