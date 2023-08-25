@extends('dashboard.templates.main')

@section('title', 'Lista de Recursos');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Recursos</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-12 col-sm-12 col-lg-2 d-flex align-items-center">
        <a href="{{ route('dashboard.documents.create') }}" class="btn btn-block btn-primary glow">Nuevo Recurso</a>
    </div>
@endsection

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <x-dashboard.alerts/>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th>version</th>
                                        <th>categoría</th>
                                        <th>actualizado</th>
                                        <th>creado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td><a href="{{ route('dashboard.documents.show', ['id' => $document->id]) }}">{{ $document->id }}</a></td>
                                            <td>{{ $document->name }}</td>
                                            <td>{{ $document->version }}</td>
                                            <td><a href="{{ route('dashboard.categories.show', ['id' => $document->category->id]) }}">{{ $document->category->name }}</a></td>
                                            <td>{{ $document->updated_at->toDateTimeString() }}</td>
                                            <td>{{ $document->created_at->toDateTimeString() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- users list ends -->
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
