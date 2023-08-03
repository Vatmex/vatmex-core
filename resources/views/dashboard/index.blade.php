@extends('dashboard.templates.main')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{ $currentMonthHours }}</h3>
                                <h6>Horas de control {{ ucfirst(now()->monthName) }}</h6>
                            </div>
                            <div>
                                <i class="icon-clock info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">{{ $lastMonthHours }}</h3>
                                <h6>Horas de control {{ ucfirst(now()->subMonth()->monthName) }}</h6>
                            </div>
                            <div>
                                <i class="icon-calendar warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ $pilotsOnline }}</h3>
                                <h6>Vuelos hacia/desde México</h6>
                            </div>
                            <div>
                                <i class="icon-plane success font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger">{{ count($controllersOnline) }}</h3>
                                <h6>Controladores en Línea</h6>
                            </div>
                            <div>
                                <i class="icon-microphone danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Aeropuertos con Actividad</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="#">Ver todos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="row" class="border-top-0">ICAO</th>
                                        <th class="border-top-0 text-right">Salídas</th>
                                        <th class="border-top-0 text-right">Llegadas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (array_slice($airportStats, 0, 5) as $airport)
                                        @if ($airport['flights'] > 0)
                                            <tr>
                                                <td scope="row" class="border-top-0">{{ $airport['icao'] }}</td>
                                                <td class="border-top-0 text-right">{{ $airport['departures'] }}</td>
                                                <td class="border-top-0 text-right">{{ $airport['arrivals'] }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Controladores del Mes</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h6 class="success text-bold-600">{{ $controllerOfTheMonthCurrent->current_month_hours }} horas</h6>
                                <h4 class="font-large-1 text-bold-400">{{ $controllerOfTheMonthCurrent->user->name }} </h4>
                                <p class="blue-grey lighten-2 mb-0">Este mes</p>
                            </div>
                            <div class="col-md-6 col-12 text-center">
                                <h6 class="success text-bold-600">{{ $controllerOfTheMonthPast->last_month_hours }} horas</h6>
                                <h4 class="font-large-1 text-bold-400">{{ $controllerOfTheMonthPast->user->name }}</h4>
                                <p class="blue-grey lighten-2 mb-0">{{ ucfirst(now()->subMonth()->monthName) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="recent-transactions" class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Controladores en Línea</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="https://map.vatsim.net/" target="_blank">Ver en Simaware</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">CID</th>
                                    <th class="border-top-0">Nombre</th>
                                    <th class="border-top-0">Callsign</th>
                                    <th class="border-top-0">Posición</th>
                                    <th class="border-top-0">Frecuencia</th>
                                    <th class="border-top-0">Duración</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($controllersOnline as $controller)
                                    <tr>
                                        <td class="text-truncate"><a href="{{ route('dashboard.atcs.show', ['cid' => $controller['cid']]) }}">{{ $controller['cid'] }}</a></td>
                                        <td class="text-truncate">{{ $controller['name'] }}</td>
                                        <td class="text-truncate">{{ $controller['callsign'] }}</td>
                                        <td class="text-truncate"><x-station :callsign="$controller['callsign']"/></td>
                                        <td class="text-truncate">{{ $controller['frequency'] }}</td>
                                        <td class="text-truncate">{{ \Carbon\Carbon::parse($controller['logon_time'])->diffForHumans() }}
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
