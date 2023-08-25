@extends('dashboard.templates.main')

@section('title', 'Agendar Sesión de Entrenamiento')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.index') }}">Estudiantes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.show', ['cid' => $student->user->cid]) }}">{{ $student->user->name }}</a></li>
        <li class="breadcrumb-item"><a href="#">Sesión</a></li>
        <li class="breadcrumb-item active">Nueva</li>
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
                                <p>Usa el sigiuente formulario para crear una sesión de entrenamiento usando hora del Centro de México. Recuerda que sera notificada por correo.</p>
                            </div>
                            <form action="{{ route('dashboard.trainingSessions.store', ['cid' => $student->user->cid]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i>Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="title">Título</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="title" class="form-control" name="title">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="student">Estudiante</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="student" class="form-control" value="{{ $student->user->cid }} - {{ $student->user->name }}" name="student" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="scheduled_time">Horario:</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="datetime-local" class="form-control" name="scheduled_time" id="scheduled_time" value="">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="description">Objetivo</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="description" rows="5" class="form-control" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Agendar Sesión
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