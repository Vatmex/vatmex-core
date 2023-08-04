@extends('dashboard.templates.main')

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Visualizar Equipo de Trabajo </span></h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <a href="{{ url('ops/site/teams/' . $team->id . '/edit') }}" class="btn btn-block btn-primary glow">Editar Equipo</a>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 align-items-center">
                <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Borrar Equipo</button>
            </div>
        </div>
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Borrar Equipo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas borrar este equipo?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ url('ops/site/teams/' . $team->id . '/delete') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Borrar Equipo</button>
                        </form>
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
                                    <td>ID:</td>
                                    <td class="users-view-username">{{ $team->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-name">{{ $team->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripción:</td>
                                    <td class="users-view-email">{{ $team->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Roles Asignados</h5>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>posición</th>
                                        <th>cid</th>
                                        <th>desvincular</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($team->staff as $staff)
                                        <tr>
                                            <td><a href="{{ url('ops/site/staff') }}/{{ $staff->id }}">{{ $staff->id }}</a></td>
                                            <td>{{ $staff->position }}</td>
                                            <td>{{ $staff->shortcode }}</td>
                                            <td><a href="{{ url('ops/site/teams/')}}/{{ $staff->id }}/unlink">desvincular</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5 class="mb-1"><i class="ft-link"></i>Agregar un Rol Staff a Equipo</h5>
                        <p>Usa el siguiente formulario para asignar una posición de staff a este equipo</p>
                        <form action="{{ url('/ops/site/teams') }}/{{ $team->id }}/link" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="single-input selectivity-input" name="role" id="role">
                                    <option hidden disabled selected value=" "> </option>
                                    @foreach ($staffs as $staff)
                                        <option value="">{{ $staff->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1" value="Agregar Rol"></input>
                            </div>
                        </form>
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
          var cities = $('#role').find('option').map(function () {
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
            placeholder: 'Selecciona un usuario',
            query: queryFunction,
            searchInputPlaceholder: 'Escribe para buscar un usuario'
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