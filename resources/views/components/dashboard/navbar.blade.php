<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ (request()->segment(2) == '') ? 'active' : '' }} nav-item"><a href="{{ url('/ops') }}"><i class="mbri-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>
            <li class="{{ (request()->segment(2) == 'site') ? 'active' : '' }} nav-item"><a href="#"><i class="mbri-desktop"></i><span class="menu-title" data-i18n="Site">Sitio</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#"><i class="mbri-users"></i><span data-i18n="Documents Menu">Staff</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('dashboard.teams.index') }}"><i></i><span data-i18n="Teams">Equipos</span></a></li>
                            <li><a class="menu-item" href="{{ route('dashboard.staff.index') }}"><i></i><span data-i18n="Positions">Posiciones</span></a></li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="#"><i class="mbri-file"></i><span data-i18n="Documents Menu">Documents</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('dashboard.categories.index') }}"><i></i><span data-i18n="Categories">Categorias</span></a></li>
                            <li><a class="menu-item" href="{{ route('dashboard.documents.index') }}"><i></i><span data-i18n="Documents">Documentos</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2) == 'atc') ? 'active' : '' }} nav-item"><a href="#"><i class="la la-gears"></i><span class="menu-title" data-i18n="Operations">Operaciones</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('dashboard.applications.index') }}"><i data-i18n="Requests" class="mbri-file"></i><span>Solicitudes</span></a></li>
                    <li><a class="menu-item" href="#"><i class="la la-bullseye"></i><span data-i18n="ATC">Controladores</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('dashboard.atcs.index') }}"><i></i><span data-i18n="Roster">Roster</span></a></li>
                            <li><a class="menu-item" href="{{ route('dashboard.feedbacks.index') }}"><i></i><span data-i18n="Feedback">Feedback</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2) == 'events') ? 'active' : '' }} nav-item"><a href="#"><i class="mbri-globe"></i><span class="menu-title" data-i18n="Events">Eventos</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ url('/ops/events/new') }}"><i class="la la-plus"></i><span>Crear Evento</span></a></li>
                    <li><a class="menu-item" href="{{ url('/ops/events') }}"><i class="la la-calendar"></i><span>Calendario</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
