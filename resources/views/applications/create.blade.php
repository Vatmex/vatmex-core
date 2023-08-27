@extends('templates.page')

@section('title', 'Solicitud CTA')

@section('breadcrumbs')
	<ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="#">ATC</a></li>
        <li class="active"><a href="{{ route('atcs.apply') }}">Solicitud CTA</a></li>
    </ul>
@endsection

@section('content')
	<div class="row">
        <div class="content col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-5">Formulario de Solicitud CTA<small>Entrenamiento</small></h3>
                    <p>Nos dedicamos a brindar servicios de tránsito aéreo en México en la red de VATSIM, nuestro enfoque es brindar un buen servicio de control de tránsito aéreo, comprometiéndonos con la profesionalidad y amabilidad que nos ha caracterizado en la red y así brindar una agradable experiencia de vuelo. Si compartes la misma visión que nosotros que esperas para ser parte del equipo de controladores. ¡Envía tu solicitud de entrenamiento!</p>
                    <p>
                    	<ul>
                    		<li>Todos los campos son obligatorios</li>
                    		<li>Los campos de Nombre, Apellido y Vatsim ID provienen directamente de tu cuenta de Vatsim y no son editables. En caso de que la información en ellos sea incorrecta, ponte en contacto con el administrador en <a href="mailto:webmaster@vatmex.com.mx">webmaster@vatmex.com.mx</a></li>
                    	</ul>
                    </p>
                    <h4>Requisitos</h4>
                    <ul>
                    	<li>Conocimientos básicos de navegación aérea</li>
                    	<li>En caso de tener experiencia en la vida real, se tomará en cuenta para reducir el tiempo de adiestramiento</li>
                    	<li>Disponibilidad para ejercer el servicio de control de tránsito aéreo en VATSIM por lo menos 5 horas al mes</li>
                    	<li>Habilidad oral y escrita de los idiomas español e inglés</li>
                    	<li>Leer y aceptar el Reglamento de Entrenamiento</li>
                    </ul>
                    <form id="form1" class="form-validate" action="{{ route('atcs.apply.store') }}" method="post">
                        @csrf
                        <div class="h5 mb-4">Account details</div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first-name">Nombre</label>
                                <input type="text" class="form-control" name="first-name" id="first-name" value="{{ Auth::user()->first_name; }}" readonly required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last-name">Apellido</label>
                                <input type="text" class="form-control" name="last-name" id="last-name" value="{{ Auth::user()->last_name; }}" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cid">Vatsim ID</label>
                                <input type="text" class="form-control" name="cid" id="cid" value="{{ Auth::user()->cid; }}" readonly required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email de contacto</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label for="txtMsg">¿Por qué quieres ser CTA?</label>
                                    <textarea name="message" id="message" class="form-control" placeholder="Escribe en tus palabras porque te quieres unir la división como CTA" style="width: 100%; min-height: 160px;" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-1 mt-5">
                            <input type="checkbox" name="privacy" id="privacy" class="form-check-input" value="1" required>
                            <label class="custom-control-label" for="privacy">He leído y aceptado la <a href="#">Política de Privacidad</a>.</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="terms" id="terms" class="form-check-input" value="1" required>
                            <label class="custom-control-label" for="terms">He leído y aceptado el <a href="#">Regalamento de Entrenamiento</a>.</label>
                        </div>
                        <button type="submit" class="btn m-t-30 mt-3">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
