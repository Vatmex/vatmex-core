@extends('dashboard.templates.main')

@section('title', 'Editar Nota de Entrenamiento')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.index') }}">Estudiantes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.students.show', ['cid' => $note->student->user->cid]) }}">{{ $note->student->user->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.trainingNotes.show', ['id' => $note->id]) }}">Nota</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <section class="users-view">
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
                                        <td class="users-view-username">{{ $note->student->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>CID:</td>
                                        <td class="users-view-name">{{ $note->student->user->cid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Creada por:</td>
                                        <td class="users-view-name">{{ \App\Models\User::where('cid', $note->created_by)->first()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Creada en:</td>
                                        <td class="users-view-email">{{ $note->created_at->isoFormat('LLLL') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('dashboard.trainingNotes.update', ['id' => $note->id]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                                <h4 class="form-section"><i class="ft-user"></i> Contenido</h4>
                                <div class="form-group row">
                                    <label class="col-md-1 label-control" for="message">Notas</label>
                                    <div class="col-md-11 mx-auto">
                                        <textarea id="message" rows="5" class="form-control" name="message" placeholder="Describe brevemente el progeso del esudiante">{!! $note->message !!}</textarea>
                                    </div>
                                </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Actualizar Nota
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