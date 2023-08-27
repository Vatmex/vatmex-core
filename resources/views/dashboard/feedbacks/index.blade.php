@extends('dashboard.templates.main')

@section('title', 'Lista de Feedback');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Feedback</li>
    </ol>
@endsection

@section('content')
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
                                        <th>cid</th>
                                        <th>email</th>
                                        <th>rating</th>
                                        <th>actualizado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td><a href="{{ route('dashboard.feedbacks.show', ['id' => $feedback->id]) }}">{{ $feedback->id }}</a></td>
                                            <td>{{ $feedback->name }}</td>
                                            <td>{{ $feedback->cid }}</td>
                                            <td>{{ $feedback->email }}</td>
                                            <td><x-rating :rating="$feedback->rating"/></td>
                                            <td>{{ $feedback->created_at->isoFormat('LLLL') }}</td>
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
