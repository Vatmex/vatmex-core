<header id="header" data-transparent="true" data-fullwidth="true" @if($type == 'dark') class="dark submenu-light" @endif>
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="{{ route('home') }}">
                    <span class="logo-default"><img src="/images/logo.png" height="70px" style="padding: 5px 0;"></span>
                    <span class="logo-dark"><img src="/images/logo-dark.png" height="70px" style="padding: 5px 0;"></span>
                </a>
            </div>
            <!--End: Logo-->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger">
                <a class="lines-button x"><span class="lines"></span></a>
            </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            <li><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="dropdown"><a href="#">Nosotros</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('about.staff') }}">Staff</a></li>
                                    <li><a href="{{ route('about.roster') }}">Roster</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Pilotos</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('pilots.feedback') }}">Feedback a Controlador</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Controladores</a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user())
                                        @if (! Auth::user()->atc)
                                            <li><a href="{{ route('atcs.apply') }}">¡Quiero ser ATC!</a></li>
                                        @endif
                                    @else
                                        <li><a href="{{ route('atcs.apply') }}">¡Quiero ser ATC!</a></li>
                                    @endif
                                    <li><a href="{{ route('atcs.documents') }}">Documentos</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('events.index') }}">Eventos</a></li>
                            <li><a href="#">Contacto</a></li>
                            @if (Auth::check())
                                <li class="dropdown"><a href="#"><i class="icon-users"></i> {{ Auth::user()->first_name }}</a>
                                    <ul class="dropdown-menu">
                                        @if(Auth::user()->atc)
                                            <li><a href="{{ route('my.index') }}">Mi VATMEX</a></li>
                                        @endif() 
                                        @can('access dashboard')
                                            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                        @endcan
                                        <li><a href="{{ route('auth.logout') }}">Cerrar Sesión</a></li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('auth.login') }}"><i class="icon-users"></i> Entrar</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
