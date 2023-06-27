@extends('dashboard.templates.main')

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">
            <form>
                <div class="row py-2 mb-2">
                    <div class="col-12 col-sm-12 col-lg-9">
                        <h3>Lista de Categorías</h3>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 d-flex align-items-center">
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-block btn-primary glow">Nueva Categoría</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <x-dashboard.alerts/>
                        <!-- datatable start -->
                        @if(!$categories->isEmpty())
                            <div class="table-responsive">
                                <table id="users-list-datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>creado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td><a href="{{ route('dashboard.categories.show', ['id' => $category->id]) }}">{{ $category->id }}</a></td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at->toDateTimeString() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4 style="text-align: center;">No hay categorias en este momento</h4>
                        @endif
                        <!-- datatable ends -->
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
            $('#users-list-datatable').DataTable();
        });
    </script>
@endsection
