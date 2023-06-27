@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Documento</span></h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <a href="{{ route('dashboard.documents.edit', ['id' => $document->id]) }}" class="btn btn-block btn-primary glow">Editar Documento</a>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Documento  </button>
            </div>
        </div>
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Borrar Posición</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas borrar este documento?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('dashboard.documents.delete', ['id' => $document->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Borrar Documento</button>
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
