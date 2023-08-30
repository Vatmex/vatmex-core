@extends('dashboard.templates.main')

@section('title', 'Log de Auditoría');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="#">Site</a>
        </li>
        <li class="breadcrumb-item active">Log de Auditoría
        </li>
    </ol>
@endsection

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>fecha</th>
                                        <th>autor</th>
                                        <th>descripción</th>
                                        <th>objetivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $activity->id }}</td>
                                            <td style="vertical-align: middle;">{{ $activity->created_at }}</td>
                                            <td style="vertical-align: middle;">
                                                @if($activity->causer)
                                                    <a href="{{ route('dashboard.users.show', ['cid' => $activity->causer->cid ]) }}">
                                                        <span class="avatar">
                                                            <img style="margin-right: 10px;" src="https://www.gravatar.com/avatar/{{ md5($activity->causer->email) }}" alt="avatar" data-toggle="tooltip" data-placement="right" title="John Doe">
                                                        </span>
                                                        {{ $activity->causer->name }}
                                                    </a>
                                                @else
                                                    <a href="#">
                                                        <span class="avatar">
                                                            <img style="margin-right: 10px;" src="/images/system-bot.jpeg" alt="avatar" data-toggle="tooltip" data-placement="right" title="John Doe">
                                                        </span>
                                                        System
                                                    </a>
                                                @endif
                                            </td style="vertical-align: middle;">
                                            <td style="vertical-align: middle;">{{ $activity->description }}</td>
                                            <td style="vertical-align: middle;"><x-dashboard.subject :subject="$activity->subject"/></td>
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
@endsection

@section('page-js')
    <script>
        $(document).ready(function () {
            $('#users-list-datatable').DataTable({
                order: [0,"desc"],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                pageLength: 100,
                columnDefs: [
                    { "type": "num", "targets": 0 }
                ],
            });
        });
    </script>
@endsection
