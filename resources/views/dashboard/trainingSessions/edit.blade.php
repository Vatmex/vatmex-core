@extends('dashboard.templates.main')

@section('content')
    <section class="users-view">
        <div class="row py-2">
            <div class="col-12 col-sm-12 col-lg-9">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">Editar Sessión</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <div class="col-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td class="users-view-username">{{ $session->student->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>CID:</td>
                                        <td class="users-view-name">{{ $session->student->user->cid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Creada por:</td>
                                        <td class="users-view-name">{{ \App\Models\User::where('cid', $session->created_by)->first()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Creada en:</td>
                                        <td class="users-view-email">{{ $session->created_at->isoFormat('LLLL') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('dashboard.trainingSessions.update', ['id' => $session->id]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <h4 class="form-section"><i class="ft-user"></i> Contenido</h4>
                            <div class="form-group row">
                                <label class="col-md-1 label-control" for="title">Título</label>
                                <div class="col-md-11 mx-auto">
                                    <input type="text" id="title" class="form-control" name="title" value="{{ $session->title }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-1 label-control" for="scheduled_time">Horario:</label>
                                <div class="col-md-11 mx-auto">
                                    <input type="datetime-local" class="form-control" name="scheduled_time" id="scheduled_time" value="{{ Carbon\Carbon::parse($session->scheduled_time, 'UTC')->setTimezone('America/Mexico_City') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-1 label-control" for="description">Objetivos</label>
                                <div class="col-md-11 mx-auto">
                                    <textarea id="description" rows="5" class="form-control" name="description" placeholder="Describe brevemente el progeso del esudiante">{!! $session->description !!}</textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script>
        'use strict';

        tinymce.init({
            selector: 'textarea',
            menubar: false,
            height: 350,
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
@endsection