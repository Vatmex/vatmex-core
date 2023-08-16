@extends('dashboard.templates.main')

@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Crear Nueva Nota de Entrenamiento</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-dashboard.alerts/>
                            <div class="card-text">
                                <p>Usa el sigiuente formulario para crear una nueva nota en el expediente del estudiante.</p>
                            </div>
                            <form action="{{ route('dashboard.trainingNotes.store', ['cid' => $student->user->cid]) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i>Información General</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="student">Estudiante</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="student" class="form-control" value="{{ $student->user->cid }} - {{ $student->user->name }}" name="student" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="message">Notas</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea id="message" rows="5" class="form-control" name="message" placeholder="Describe brevemente el progeso del esudiante"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="visible">Visibilidad</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="checkbox" id="visible" name="visible" value="1"> Mostrar nota al estudiante
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Crear Nota
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
