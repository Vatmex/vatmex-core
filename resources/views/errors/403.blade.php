@extends('templates.error')

@section('title', '403')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="page-error-404">403</div>
        </div>
        <div class="col-lg-6">
            <div class="text-start">
                <h1 class="text-medium">Oops, No tienes permiso para accesar!</h1>
                <p class="lead">Lo mas probable es que haya expirado tu sesión, inicia sesión y vuelve a intentar. Si ya iniciaste sesión y aun ves este error, no tienes permiso para accesar este recurso.</p>
                <p>Si crees que es un error, contacta al <a href="mailto:webmaster@vatmex.com.mx">administrador</a>. No olvides avisarle que tienes información <x-phonetic/>.</p>
            </div>
        </div>
    </div>
@endsection
