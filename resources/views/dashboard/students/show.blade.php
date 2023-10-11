@extends('dashboard.templates.main')

@section('title', 'Detalle Estudiante');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.index')}}">Estudiantes</a></li>
        <li class="breadcrumb-item active">{{ $student->user->name }}</li>
    </ol>
@endsection

@section('controls')
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    <div class="col-0 col-sm-0 col-lg-2 d-flex align-items-center"></div>
    @can('remove students')
        <div class="col-12 col-sm-12 col-lg-2 align-items-center">
            <button class="btn btn-block btn-danger glow" id="modal-button" data-toggle="modal" data-target="#default">Desactivar Estudiante</button>
        </div>
    @else
        <div class="col-12 col-sm-12 col-lg-2 align-items-center"></div>
    @endcan
@endsection

@section('content')
    <!-- users view start -->
    <section class="users-view">
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Desactivar Estudiante</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center;">¿Estas seguro de que deseas detener la instrucción de {{ $student->user->name }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('dashboard.students.remove', ['cid' => $student->user->cid])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Desactivar Estudiante</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $student->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $student->user->cid }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="users-view-name">{{ $student->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Instructor:</td>
                                    <td class="users-view-name"><a href="{{ route('dashboard.instructors.show', ['cid' => $student->instructor->user->cid]) }}">{{ $student->instructor->user->name }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Notas Entrenamiento</h5>
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>fecha</th>
                                        <th>autor</th>
                                        <th>visibilidad</th>
                                        <th>acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->notes as $note)
                                        <tr>
                                            <td>{{ $note->id }}</td>
                                            <td>{{ $note->created_at->isoFormat('LLLL') }}</td>
                                            <td><a href="{{ route('dashboard.instructors.show', ['cid' => \App\Models\User::where('cid', $note->created_by)->first()->cid]) }}">{{ \App\Models\User::where('cid', $note->created_by)->first()->name }}</td>
                                            <td>{{ ($note->visible_to_student) ? 'alumno' : 'instructores' }}</td>
                                            <td><a href="{{ route('dashboard.trainingNotes.show', ['id' => $note->id]) }}">ver</a>  @if(\Auth::user()->cid == $note->created_by) | <a href="{{ route('dashboard.trainingNotes.edit', ['id' => $note->id]) }}">editar</a> @endif</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5 class="mb-1"><i class="ft-link"></i>Sesiones Entrenamiento</h5>
                        <div class="table-responsive">
                            <table id="users-list-2-datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>fecha</th>
                                        <th>título</th>
                                        <th>instructor</th>
                                        <th>estatus</th>
                                        <th>acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->sessions as $session)
                                        <tr>
                                            <td>{{ $session->id }}</th>
                                            <!-- TODO: Allow for user selected timezones  -->
                                            <td>{{ Carbon\Carbon::parse($session->scheduled_time, 'UTC')->setTimezone('America/Mexico_City')->isoFormat('LLLL') }}</th>
                                            <td>{{ $session->title }}</th>
                                            <td><a href="{{ route('dashboard.instructors.show', ['cid' => \App\Models\User::where('cid', $session->created_by)->first()->cid]) }}">{{ \App\Models\User::where('cid', $session->created_by)->first()->name }}</a></th>
                                            <td>{!! ($session->canceled) ? '<span class="badge badge-danger">cancelada</span>' : '<span class="badge badge-success">normal</span>'; !!}</td>
                                            <td><a href="{{ route('dashboard.trainingSessions.show', ['id' => $session->id]) }}">ver</a> @if(\Auth::user()->cid == $session->created_by && $session->canceled != true) |  <a href="{{ route('dashboard.trainingSessions.edit', ['id' => $session->id]) }}">editar</a> @endif</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @can ('assign applications')
                            <h5 class="mb-1"><i class="ft-link"></i>Siguientes pasos</h5>
                            <p>Usa el siguiente formulario para asignar un instructor</p>
                            <form action="{{ route('dashboard.students.assign', ['cid' => $student->user->cid]) }}" method="post">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script>
        $(document).ready(function () {
            $('#users-list-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nueva Nota',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "{{ route('dashboard.trainingNotes.create', ['cid' => $student->user->cid]) }}";
                        }
                    }
                ]
            });
        });

        $(document).ready(function () {
            $('#users-list-2-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nueva Sesión',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "{{ route('dashboard.trainingSessions.create', ['cid' => $student->user->cid]) }}";
                        }
                    }
                ]
            });
        });

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
