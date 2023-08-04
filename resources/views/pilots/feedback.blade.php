@extends('templates.page')

@section('title', 'Feedback')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="#">Pilotos</a></li>
        <li class="active"><a href="{{ route('pilots.feedback') }}">Feedback</a></li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="content col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-5">Formulario de Feedback CTA<small>Operaciones</small></h3>
                    <p>
                        En VATMEX, nos enfocamos en el profesionalismo de nuestros controladores para que la comunidad de aviación virtual obtenga el mayor realismo posible. Si durante tu vuelo tuviste una agradable experiencia de control y quieres compartir, deja tu comentario hacia nuestros controladores utilizando el siguiente formulario. De igual forma, aceptamos cualquier sugerencia que nos ayude a mejorar para seguir ofreciendo la mejor experiencia dentro del espacio aéreo virtual mexicano.</p>
                    <p>
                        <ul>
                            <li>Todos los campos son obligatorios</li>
                            <li>Los campos de Nombre, Apellido y Vatsim ID provienen directamente de tu cuenta de Vatsim y no son editables. En caso de que la información en ellos sea incorrecta, ponte en contacto con el administrador en <a href="mailto:webmaster@vatmex.com.mx">webmaster@vatmex.com.mx</a></li>
                        </ul>
                    </p>
                    <form id="form1" class="form-validate" action="{{ route('pilots.feedback.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name; }}" readonly required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cid">Vatsim ID</label>
                                <input type="text" class="form-control" name="cid" id="cid" value="{{ Auth::user()->cid; }}" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email de contacto</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rating">Calificación</label>
                                <select class="form-control" name="rating" id="rating" required>
                                    <option value="1">Pésima</option>
                                    <option value="2">Mala</option>
                                    <option value="3" selected>Regular</option>
                                    <option value="4">Buena</option>
                                    <option value="5">Excelente</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="position">Posición</label>
                                <input type="text" class="form-control" name="position" id="position" required placeholder="MMMX_CTR">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="controller_id">Controlador</label>
                                <select class="form-control" name="controller_id" id="controller_id" required>
                                    @foreach ($atcs as $atc)
                                        <option value="{{ $atc->id }}">{{ $atc->user->cid }} - {{ $atc->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtMsg">¿Cual es tu feedback?</label>
                                    <textarea name="message" id="message" class="form-control" placeholder="Escribe en tus palabras tu experiencia con el controlador" style="width: 100%; min-height: 160px;" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-1 mt-5">
                            <input type="checkbox" name="reminders" id="reminders" class="form-check-input" value="1" required>
                            <label class="custom-control-label" for="terms_conditions">He leído y aceptado la <a href="#">Política de Privacidad</a>.</label>
                        </div>
                        <button type="submit" class="btn m-t-30 mt-3">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
