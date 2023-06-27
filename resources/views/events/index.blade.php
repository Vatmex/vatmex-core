@extends('templates.page')

@section('title', 'Eventos')

@section('breadcrumbs')
	<ul>
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active"><a href="{{ url('/events') }}">Eventos</a></li>
    </ul>
@endsection

@section('content')
	<div class="container">
        <!-- Calendar -->
        <div class="row mb-5">
            <div class="col-lg-6">
                <h4>Calendario de Eventos</h4>
            </div>
            <div class="col-lg-6"><button type="button" class="btn btn-light btn-shadow float-right"><i class="icon-calendar"></i>
                    Solicitar CTA</button></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="calendar"></div>
            </div>
        </div>
        <!-- end: Calendar -->
    </div>
@endsection

@section('page-js')
    <script>
        $('#calendar').fullCalendar({
            defaultDate: '{{ \Carbon\Carbon::now()->toDateString() }}',
            editable: false,
            plugins: ["dayGrid", "interaction"],
            eventLimit: true, // allow "more" link when too many events
            events: [
                @foreach($events as $event)
                {
                    title: '{{ $event->name }}',
                    url: '{{ url('/events') }}/{{ $event->slug }}',
                    start: '{{ $event->start }}'
                },
                @endforeach
            ]
        });
    </script>
@endsection
