<footer id="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="widget">
                        <div class="widget-title">Virtual Air Traffic México</div>
                        <p class="mb-5"> VATMEX es la división mexicana de <a href="#">VATSIM</a>. Nuestro propósito es brindar servicio de control de tránsito aéreo en México, al igual que proveer constante entrenamiento  y recursos a controladores y pilotos virtuales que deseen participar en la división.</p>
                        @if (Auth::user())
                            @if (! Auth::user()->atc())
                                <a href="{{ route('atcs.apply') }}" class="btn btn-inverted">¡Quiero ser ATC!</a>
                            @endif
                        @else
                            <div><a href="{{ route('atcs.apply') }}" class="btn btn-success scroll-to">¡Quiero ser ATC!</a></div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Ligas</div>
                                <ul class="list">
                                    <li><a href="#">Facebook</a></li>
                                    <li><a href="#">Discord</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Pilotos</div>
                                <ul class="list">
                                    <li><a href="#">Cartas</a></li>
                                    <li><a href="#">Eventos</a></li>
                                    <li><a href="#">Solicitar ATC</a></li>
                                    <li><a href="#">Feedback</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Controladores</div>
                                <ul class="list">
                                    <li><a href="#">Documentos</a></li>
                                    <li><a href="#">Vatsys</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Legal</div>
                                <ul class="list">
                                    <li><a href="#">Aviso de Privacidad</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Contacto</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-content">
        <div class="container">
            <div class="copyright-text text-center">&copy; 2023 Virtual Air Traffic México</div>
        </div>
    </div>
</footer>
