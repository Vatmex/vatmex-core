@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Categoría</span></h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <a href="{{ route('dashboard.categories.edit', ['id' => $category->id]) }}" class="btn btn-block btn-primary glow">Editar Categoría</a>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Categoría  </button>
            </div>
        </div>
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Borrar Categoría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas borrar esta categoría?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('dashboard.categories.delete', ['id' => $category->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Borrar Categoría</button>
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
                                    <td class="users-view-username">{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripción:</td>
                                    <td class="users-view-name">{{ $category->description }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td class="users-view-email">{{ $category->created_at->isoFormat('llll') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Documentos</h5>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th>versión</th>
                                        <th>creado</th>
                                        <th>actualizado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->documents as $document)
                                        <tr>
                                            <td><a href="{{ route('dashboard.documents.show', ['id' => $document->id]) }}">{{ $document->id }}</a></td>
                                            <td>{{ $document->name }}</td>
                                            <td>{{ $document->version }}</td>
                                            <td>{{ $document->updated_at->isoFormat('llll') }}</td>
                                            <td>{{ $document->created_at->isoFormat('llll') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->
    </section>
@endsection

@section('page-js')
    <script>
        $(document).ready(function () {
            $('#users-list-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
            });
        });
    </script>
@endsection
