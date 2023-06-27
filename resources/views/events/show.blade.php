@extends('templates.page')

@section('title', $event->name)

@section('breadcrumbs')
	<ul>
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/events') }}">Eventos</a></li>
        <li class="active"><a href="{{ url('/events') }}/{{ $event->slug }}">{{ $event->name }}</a></li>
    </ul>
@endsection

@section('content')
	<div class="container">
                <div class="row m-b-40">
                    <div class="sidebar sticky-sidebar col-lg-4">
                        <div class="project-description">
                            <h3>{{ $event->description }}</h3>
                        </div>
                        <div class="portfolio-attributes style2">
                            <div class="attribute"><strong>Inicio:</strong> {{ Carbon\Carbon::parse($event->start)->format('l d M Y, H:i') }} UTC</div>
                            <div class="attribute"><strong>Final:</strong> {{ Carbon\Carbon::parse($event->end)->format('l d M Y, H:i') }} UTC</div>
                            <div class="attribute"><strong>Aerodromos Salida:</strong> {{ $event->departure_airfields}}</div>
                            <div class="attribute"><strong>Aerodromos Llegada:</strong> {{ $event->arrival_airfields }}</div>
                        </div>
                    </div>
                    <div class="col-lg-7 offset-1">
                        <div class="portfolio-content" data-lightbox="gallery">
                            <a title="Saiba Chair" data-lightbox="gallery-image" href="images/portfolio/project/30.jpg">
                                <img src="{{ url('/storage/'.$event->banner_path) }}" data-animate="fadeInUp">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-navigation">
                @if ($previousEvent)
                    <a href="{{ url('events') }}/{{ $previousEvent->slug }}" class="post-prev">
                        <div class="post-prev-title"><span>Previo Evento</span>{{ $previousEvent->name }}</div>
                    </a>
                @endif
                <a href="{{ url('events') }}" class="post-all">
                    <i class="icon-grid"> </i>
                </a>
                @if ($nextEvent)
                    <a href="{{ url('events') }}/{{ $nextEvent->slug }}" class="post-next">
                        <div class="post-next-title"><span>Siguiente</span>{{ $nextEvent->name }}</div>
                    </a>
                @endif
            </div>
        </section>
@endsection
