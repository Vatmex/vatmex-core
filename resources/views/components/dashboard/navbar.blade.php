<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ (request()->segment(2) == '') ? 'active' : '' }} nav-item"><a href="{{ url('/ops') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>
            <li class="{{ (request()->segment(2) == 'site') ? 'active' : '' }} nav-item"><a href="#"><i class="la la-desktop"></i><span class="menu-title" data-i18n="Site">Sitio</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#"><i class="la la-user-friends"></i><span data-i18n="Documents Menu">Staff</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('dashboard.teams.index') }}"><i></i><span data-i18n="Teams">Equipos</span></a></li>
                            <li><a class="menu-item" href="{{ route('dashboard.staff.index') }}"><i></i><span data-i18n="Positions">Posiciones</span></a></li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="#"><i class="la la-folder"></i><span data-i18n="Documents Menu">Documents</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('dashboard.categories.index') }}"><i></i><span data-i18n="Categories">Categorias</span></a></li>
                            <li><a class="menu-item" href="{{ route('dashboard.documents.index') }}"><i></i><span data-i18n="Documents">Documentos</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2) == 'training') ? 'active' : '' }} nav-item"><a href="#"><i class="la la-school"></i><span class="menu-title" data-i18n="Trainig">Entrenamiento</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('dashboard.applications.index') }}"><i data-i18n="Requests" class="la la-wpforms"></i><span>Solicitudes</span></a></li>
                    <li><a class="menu-item" href="{{ route('dashboard.instructors.index') }}"><i data-i18n="Requests" class="la la-chalkboard-teacher"></i><span>Instructores</span></a></li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2) == 'atc') ? 'active' : '' }} nav-item"><a href="#"><i class="la la-gears"></i><span class="menu-title" data-i18n="Operations">Operaciones</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('dashboard.atcs.index') }}"><i data-i18n="Requests" class="la la-bullseye"></i><span>Roster</span></a></li>
                    <li><a class="menu-item" href="{{ route('dashboard.feedbacks.index') }}"><i data-i18n="Requests" class="la la-comments"></i><span>Feedback</span></a></li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2) == 'events') ? 'active' : '' }} nav-item"><a href="#"><i class="la la-globe"></i><span class="menu-title" data-i18n="Events">Eventos</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ url('/ops/events/new') }}"><i class="la la-calendar-plus"></i><span>Crear Evento</span></a></li>
                    <li><a class="menu-item" href="{{ url('/ops/events') }}"><i class="la la-calendar"></i><span>Calendario</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
