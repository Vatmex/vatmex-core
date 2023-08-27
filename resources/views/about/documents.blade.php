
@extends('templates.page')

@section('title', 'Políticas')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="#">Controladores</a></li>
        <li class="active"><a href="{{ route('atcs.documents') }}">Recursos</a></li>
    </ul>
@endsection

@section('content')
    @foreach ($categories as $category)
        <div class="heading-text heading-section text-center">
            <h2>{{ $category->name }}</h2>
            <span>{{ $category->description }}</span>
        </div>
        @foreach ($category->documents as $document)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $document->name }}</h3>
                            <h4 class="card-subtitle mb-2 text-muted">{{ $document->created_at->toDayDateTimeString() }}</h4>
                            <p class="card-text">{{ $document->description }}</p>
                            <a href="{{ url('/storage/'.$document->document_path) }}" class="card-link" download>Descargar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
