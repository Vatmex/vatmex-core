@extends('dashboard.templates.main')

@section('content')
    <!-- Full calendar basic example section start -->
    <section id="basic-examples">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Calendario de Eventos</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div id='fc-default'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script>
        $(document).ready(function(){
            var calendarEl = document.getElementById('fc-default');
            var fcCalendar = new FullCalendar.Calendar(calendarEl, {
                defaultDate: '{{ \Carbon\Carbon::now()->toDateString() }}',
                editable: false,
                plugins: ["dayGrid", "interaction"],
                eventLimit: true, // allow "more" link when too many events
                events: [
                    @foreach($events as $event)
                    {
                        title: '{{ $event->name }}',
                        url: '{{ url('/ops/events') }}/{{ $event->slug }}',
                        start: '{{ $event->start }}'
                    },
                    @endforeach
                ]
            });

            fcCalendar.render();
        });
    </script>
@endsection
