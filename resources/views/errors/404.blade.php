@extends('templates.error')

@section('title', '404')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="page-error-404">404</div>
        </div>
        <div class="col-lg-6">
            <div class="text-start">
                <h1 class="text-medium">Oops, No pudimos encontrar esta página!</h1>
                <p class="lead">La página que buscas pudo haber sido removida, cambió de nombre, estar temporalmente no disponible, o se la comió el ganso.</p>
                <p>Si crees que es un error, contacta al <a href="mailto:webmaster@vatmex.com.mx">administrador</a>. No olvides avisarle que tienes información <x-phonetic/>.</p>
            </div>
        </div>
    </div>
@endsection
