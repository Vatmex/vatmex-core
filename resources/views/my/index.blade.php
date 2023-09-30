@extends('my.templates.main')

@section('content')
<section id="page-account-settings">
    <div class="row">
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item">
                    <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                        <i class="la la-globe mr-50"></i>
                        General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" id="account-pill-training" data-toggle="pill" href="#account-vertical-training" aria-expanded="false">
                        <i class="la la-school mr-50"></i>
                        Training
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                <div class="media">
                                    <a href="javascript: void(0);">
                                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" class="rounded mr-75" alt="profile image" height="64" width="64">
                                    </a>
                                    <div class="media-body mt-75">
                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                            <a href="https://gravatar.com/" target="_blank" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Cambiar mi Avatar</a>
                                        </div>
                                        <p class="text-muted ml-75 mt-50"><small>Los avatars de este sitio son administrados a traves del tercero Gravatar.</small></p>
                                    </div>
                                </div>
                                <hr>
                                <p>Los datos de tu cuenta son suministrados directamente por Vatsim al momento de crear tu cuenta. Si existe un error o buscas actualizar alguna de la información aquí mostrada, por favor contacta al administrador en <a href="mailto:webmaster@vatmex.com.mx">webmaster@vatmex.com.mx</a>. No olvides avisarle que tienes información <x-phonetic/>.</p>
                                <form novalidate="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Nombre</label>
                                                    <input type="text" class="form-control" id="account-username" value="{{ Auth::user()->name }}" readonly>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">CID</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ Auth::user()->cid }}" readonly>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">E-mail</label>
                                                    <input type="email" class="form-control" id="account-e-mail" value="{{ Auth::user()->email }}" readonly>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade " id="account-vertical-training" role="tabpanel" aria-labelledby="account-pill-training" aria-expanded="false">
                                <h3>Mi Instructor</h3>
                                <br>
                                <form novalidate="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Nombre - CID</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $instructor->user->name }} - {{ $instructor->user->cid }}" readonly>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Email</label>
                                                    <input type="text" class="form-control" id="account-username" value="{{ ($instructor->user->staff) ? $instructor->user->staff->email : $instructor->user->email }}" readonly>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Accion</label>
                                                    <a href="mailto:{{ ($instructor->user->staff) ? $instructor->user->staff->email : $instructor->user->email }}" class="form-control btn btn-primary mr-sm-1 mb-1 mb-sm-0" style="color: white;">Enviar Correo</a>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <h3>Mi Próxima Sesión</h3>
                                <hr>
                                <h3>Notas de Entrenamiento</h3>
                                <div class="col-12">
                                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                        <div class="card accordion collapse-icon accordion-icon-rotate">
                                            @forelse ($student->notes as $index => $note)
                                                <a id="heading1{{$index + 1}}" class="card-header info" data-toggle="collapse" href="#accordion1{{ $index + 1 }}" aria-expanded="{{ ($index == 0) ? 'true' : 'false' }}" aria-controls="accordion1{{ $index + 1 }}">
                                                    <div class="card-title lead">Nota #{{ $note->id }} - {{ $note->created_at->isoFormat('LLLL') }}UTC</div>
                                                </a>
                                                <div id="accordion1{{ $index + 1 }}" role="tabpanel" data-parent="#accordionWrap{{ $index + 1 }}" aria-labelledby="heading1{{ $index + 1 }}" class="collapse show">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            {!! $note->message !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <br>
                                                <p>Aun no tienes ninguna nota de entrenamiento en tu expediente. Sigue avanzando en tu entrenamiento y seguramente veras notas aquí pronto.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                <div class="row">
                                    <h6 class="ml-1 mb-2">Activity</h6>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="switchery" data-size="sm" checked="" id="accountSwitch1" data-switchery="true" style="display: none;"><span class="switchery switchery-small switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            <label class="ml-50" for="accountSwitch1">Email me when someone comments
                                                onmy
                                                article</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="switchery" data-size="sm" checked="" id="accountSwitch2" data-switchery="true" style="display: none;"><span class="switchery switchery-small switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            <label for="accountSwitch2" class="ml-50">Email me when someone answers on
                                                my
                                                form</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="switchery" data-size="sm" id="accountSwitch3" data-switchery="true" style="display: none;"><span class="switchery switchery-small switchery-default" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            <label for="accountSwitch3" class="ml-50">Email me hen someone follows
                                                me</label>
                                        </div>
                                    </div>
                                    <h6 class="ml-1 my-2">Application</h6>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="switchery" data-size="sm" checked="" id="accountSwitch4" data-switchery="true" style="display: none;"><span class="switchery switchery-small switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            <label for="accountSwitch4" class="ml-50">News and announcements</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="switchery" data-size="sm" id="accountSwitch5" data-switchery="true" style="display: none;"><span class="switchery switchery-small switchery-default" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            <label for="accountSwitch5" class="ml-50">Weekly product updates</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="switchery" data-size="sm" checked="" id="accountSwitch6" data-switchery="true" style="display: none;"><span class="switchery switchery-small switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            <label for="accountSwitch6" class="ml-50">Weekly blog digest</label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                            changes</button>
                                        <button type="reset" class="btn btn-light">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
