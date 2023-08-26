@extends('dashboard.templates.main')

@section('title', 'Crear Posición Staff');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.staff.index') }}">Staff</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
@endsection

@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para crear una nueva posición de staff. Si el email de staff queda vació se tomara el email del usuario asignado.  Si tienes dudas sobre el formulario comunicate con el administrador del la página.</p>
                            </div>
                            <form action="{{ route('dashboard.staff.store') }}" method="post" class="form form-horizontal">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="position">Posición</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="position" class="form-control" placeholder="Nombre del Equipo" name="position">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="shortcode">Shortcode</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="shortcode" class="form-control" placeholder="Shortcode" name="shortcode">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="email">Email de Staff</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="email" class="form-control" placeholder="ejemplo@vatmex.com.mx" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Descripción del Puesto</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el puesto"></textarea>
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-users"></i> Asignación Equipo</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Equipo de Trabajo</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="single-input selectivity-input" name="team" id="team">
                                                <option hidden disabled selected value=" "> </option>
                                                @foreach ($teams as $team)
                                                    <option value="">{{ $team->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Crear Posición
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
          var cities = $('#team').find('option').map(function () {
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
