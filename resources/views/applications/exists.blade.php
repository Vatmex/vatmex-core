@extends('templates.page')

@section('title', 'Solicitud CTA')

@section('breadcrumbs')
	<ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li class="active"><a href="{{ route('atcs.apply') }}">Solicitud CTA</a></li>
    </ul>
@endsection

@section('modal')
    <div class="modal fade" id="modal" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">¿Estas seguro?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Si canceleas tu solicitud y cambias de opinión, se perdera tu lugar en la fila y tu nueva solicitud sera colocada hasta el final de la fila.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-b" data-bs-dismiss="modal">¡Puedo esperar!</button>
                    <button form="deleteApplication" type="submit" class="btn btn-danger">Cancelar Solicitud</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
	<div class="row">
        <div class="content col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-5">¡Ya existe una aplicación CTA en proceso para tu CID!</small></h3>
                    <p>Muchas gracias por tu interes en participar con nosotros como CTA. Revisando nuestros registros notamos que ya existe una solicitud CTA para tu Vatsim ID. Si hemos tardado en contestar no te hemos olvidado pero desafortunadamente tenemos una lista de espera algo elevada al momento.</p>
                    <p>Si consideras que existe algun error o quieres platicar el tema siempre estamos disponibles en nuestro <a href="https://discord.gg/9TAvCnwQzz">Discord</a> o directamente a alguno de los correos que puedes encontrar en la sección de <a href="{{ route('about.staff') }}">Staff.</a></p>
                    <h4>Cancelar mi solicitud CTA</h4>
                    <p>Por otro lado, si deseas cancelar tu aplicación puedes hacerlo dando click en el botón de cancelar que se encuentra mas abajo. (Nota: Si canceleas tu solicitud y cambias de opinión, se perdera tu lugar en la fila y tu nueva solicitud sera colocada hasta el final de la fila)</p>
                    <a class="btn btn-danger" data-bs-target="#modal" data-bs-toggle="modal" href="#">¡Quiero cancelar mi solicitud!</a>
                </div>
            </div>
        </div>
    </div>
    <form id="deleteApplication" method="post" action="{{ route('atcs.apply.destroy') }}">@csrf</form>
@endsection
