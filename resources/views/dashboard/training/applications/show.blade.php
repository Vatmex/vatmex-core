@extends('dashboard.templates.main')

@section('title', 'Detalle de Solicitud');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.applications.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">{{ $application->user->name }}</li>
    </ol>
@endsection

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row">
            <div class="col-12 col-sm-7">
                <div class="media mb-2">
                    <a class="mr-1" href="#">
                        <img src="https://www.gravatar.com/avatar/{{ md5($application->email) }}" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                    </a>
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">{{ $application->user->name }} </span></h4>
                        <span>CID:</span>
                        <span class="users-view-id">{{ $application->user->cid }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card details start -->
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $application->user->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Apellido:</td>
                                    <td class="users-view-name">{{ $application->user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>E-mail Solicitud:</td>
                                    <td class="users-view-email">{{ $application->email }}</td>
                                </tr>
                                <tr>
                                    <td>E-mail Vatsim:</td>
                                    <td class="users-view-email">{{ $application->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Vatsim ID:</td>
                                    <td>{{ $application->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Mensaje solicitud:</td>
                                    <td>{{ $application->message }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Información Vatsim</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Región:</td>
                                    <td><a href="#">{{ $vatsim['region'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>División:</td>
                                    <td><a href="#">{{ $vatsim['division'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Subdivisión:</td>
                                    <td><a href="#">{{ $vatsim['subdivision'] }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                        @if (!$application->processed)
                            @can ('assign applications')
                                <h5 class="mb-1"><i class="ft-link"></i>Siguientes pasos</h5>
                                <p>Usa el siguiente formulario para asignar un instructor</p>
                                <form action="{{ route('dashboard.applications.assign', ['id' => $application->id]) }}" method="post">
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
                        @else
                            <h5 class="mb-1"><i class="ft-link"></i>Instructor</h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Instructor:</td>
                                        <td>{{ $application->user->atc->instructor->user->cid }} - {{ $application->user->atc->instructor->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha asignación:</td>
                                        <td>{{ $application->user->atc->created_at->toDayDateTimeString() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
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
    </script>
@endsection
