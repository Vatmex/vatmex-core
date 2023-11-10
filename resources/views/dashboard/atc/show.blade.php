@extends('dashboard.templates.main')

@section('title', 'Detalle Controlador');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.atcs.index')}}">Roster</a></li>
        <li class="breadcrumb-item active">{{ $atc->user->name }}</li>
    </ol>
@endsection

@section('controls')
    @can('create instructors')
        @if (!$atc->user->instructor_profile)
            <div class="col-12 col-sm-12 col-lg-2 align-items-center">
                <a href="{{ route('dashboard.instructors.store', ['cid' => $atc->user->cid]) }}" class="btn btn-block btn-success glow">Promover a Instructor</a>
            </div>
        @else
            <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
        @endif
    @else
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
    @endcan
    @can ('edit atcs')
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <a href="{{ route('dashboard.atcs.edit', ['cid' => $atc->user->cid]) }}" class="btn btn-block btn-primary glow">Editar Controlador</a>
        </div>
    @else
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
    @endcan
    @if ($atc->inactive)
        @can('edit atcs')
            <div class="col-12 col-sm-12 col-lg-2 align-items-center">
                <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Reactivar Controlador  </button>
            </div>
        @else
            <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
        @endcan
    @else
        @can('edit atcs')
            <div class="col-12 col-sm-12 col-lg-2 align-items-center">
                <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Suspender Controlador  </button>
            </div>
        @else
            <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
        @endcan
    @endif
@endsection

@section('content')
    <section class="users-view">
        @if ($atc->inactive)
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel1">Activar Controlador</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="text-align: center;">¿Estas seguro de que deseas reactivar este controlador?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('dashboard.atcs.activate', ['cid' => $atc->user->cid])}}" method="post">
                                @csrf
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-outline-danger">Activar Controlador</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel1">Desactivar Controlador</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="text-align: center;">¿Estas seguro de que deseas desactivar este controlador?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('dashboard.atcs.deactivate', ['cid' => $atc->user->cid])}}" method="post">
                                @csrf
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-outline-danger">Desactivar Controlador</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $atc->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $atc->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Iniciales:</td>
                                    <td class="users-view-name">{{ $atc->initials }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="users-view-name">{{ $atc->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Rango:</td>
                                    <td class="users-view-email"><x-rank :rank="$atc->rank"/></td>
                                </tr>
                                <tr>
                                    <td>Estatus:</td>
                                    <td class="users-view-email">{{ ($atc->inactive ? 'Inactivo' : 'Activo') }}</td>
                                </tr>
                                <tr>
                                    <td>CTA Desde:</td>
                                    <td class="users-view-email">{{ $atc->created_at->isoFormat('LLLL') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Estadísticas</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Horas Mes en Curso:</td>
                                    <td class="users-view-email">{{ $atc->current_month_hours }}</td>
                                </tr>
                                <tr>
                                    <td>Horas Mes Anterior:</td>
                                    <td class="users-view-email">{{ $atc->last_month_hours }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Posiciones Autorizadas</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Autorizaciones:</td>
                                    <td class="users-view-username">{{ ($atc->delivery) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Terrester:</td>
                                    <td class="users-view-name">{{ ($atc->ground) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Torre:</td>
                                    <td class="users-view-email">{{ ($atc->tower) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Aproximación</td>
                                    <td class="users-view-email">{{ ($atc->approach) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Centro</td>
                                    <td class="users-view-email">{{ ($atc->center) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                                <tr>
                                    <td>Supercentro</td>
                                    <td class="users-view-email">{{ ($atc->supercenter) ? 'Autorizado' : 'No Autorizado'; }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if(!$atc->is_training)
                            @can ('assign students')
                                <h5 class="mb-1"><i class="ft-link"></i>Asignar insturctor</h5>
                                <p>Usa el siguiente formulario para asignar un instructor</p>
                                <form action="{{ route('dashboard.students.assign', ['cid' => $atc->user->cid]) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <select class="single-input selectivity-input" name="instructor" id="instructor">
                                            <option hidden disabled selected value=" "> </option>
                                            @foreach ($instructors as $instructor)
                                                <option value="">{{ $instructor->user->cid }} - {{ $instructor->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1" value="Asignar Instructor"></input>
                                        <button type="button" class="btn btn-primary btn-min-width mr-1 mb-1">Enviar E-Mail</button>
                                    </div>
                                </form>
                            @endcan
                        @endif
                        <h5 class="mb-1"><i class="ft-link"></i>Feedback</h5>
                        @can('view feedback')
                            <div class="table-responsive">
                                <table id="users-list-datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>cid</th>
                                            <th>email</th>
                                            <th>rating</th>
                                            <th>actualizado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($atc->feedbacks as $feedback)
                                            <tr>
                                                <td><a href="{{ route('dashboard.feedbacks.show', ['id' => $feedback->id]) }}">{{ $feedback->id }}</a></td>
                                                <td>{{ $feedback->name }}</td>
                                                <td>{{ $feedback->cid }}</td>
                                                <td>{{ $feedback->email }}</td>
                                                <td><x-rating :rating="$feedback->rating"/></td>
                                                <td>{{ $feedback->created_at->toDayDateTimeString() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No tienes permiso para ver el feedback de otros controladores</p>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->
    </section>
@endsection

@section('page-js')
    <script>
        (function (window, document, $) {
          'use strict';

          /* global $ */

          function escape(string) {
            return string ? String(string).replace(/[&<>"']/g, function (match) {
              return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                '\'': '&#39;'
              }[match];
            }) : '';
          }

          // Get all the cities from single-select-box
          var cities = $('#instructor').find('option').map(function () {
            return this.textContent;
          }).get();

          var transformText = $.fn.selectivity.transformText;

          // example query function that returns at most 10 cities matching the given text
          function queryFunction(query) {
            var selectivity = query.selectivity;
            var term = query.term;
            var offset = query.offset || 0;
            var results;
            if (selectivity.$el.attr('id') === 'single-input-with-submenus') {
              if (selectivity.dropdown) {
                var timezone = selectivity.dropdown.highlightedResult.id;
                results = citiesWithTimezone.filter(function (city) {
                  return transformText(city.id).indexOf(transformText(term)) > -1 &&
                    city.timezone === timezone;
                }).map(function (city) { return city.id; });
              } else {
                query.callback({ more: false, results: [] });
                return;
              }
            } else {
              results = cities.filter(function (city) {
                return transformText(city).indexOf(transformText(term)) > -1;
              });
            }
            results.sort(function (a, b) {
              a = transformText(a);
              b = transformText(b);
              var startA = (a.slice(0, term.length) === term),
                startB = (b.slice(0, term.length) === term);
              if (startA) {
                return (startB ? (a > b ? 1 : -1) : -1);
              } else {
                return (startB ? 1 : (a > b ? 1 : -1));
              }
            });
            setTimeout(function () {
              query.callback({
                more: results.length > offset + 10,
                results: results.slice(offset, offset + 10)
              });
            }, 500);
          }

          // default select
          $('.single-input').selectivity({
            allowClear: true,
            placeholder: 'Selecciona un instructor',
            query: queryFunction,
            searchInputPlaceholder: 'Escribe para buscar un instructor'
          });
        })(window, document, jQuery);
        
        $(document).ready(function () {
            $('#users-list-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
            });
        });
    </script>
@endsection
