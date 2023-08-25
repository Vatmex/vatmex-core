@extends('dashboard.templates.main')

@section('title', 'Visualizar Feedback');

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.feedbacks.index') }}">Feedback</a></li>
        <li class="breadcrumb-item active">Visualizar</li>
    </ol>
@endsection

@section('content')
    <section class="users-view">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <x-dashboard.alerts/>
                        <h5 class="mb-1"><i class="ft-link"></i>Información Usuario Feedback</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $feedback->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name">{{ $feedback->cid }}</td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td class="users-view-email">{{ $feedback->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Información Controlador</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="users-view-username">{{ $feedback->atc->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>CID:</td>
                                    <td class="users-view-name"><a href="{{ route('dashboard.atcs.show', ['cid' => $feedback->atc->user->cid])}}">{{ $feedback->atc->user->cid }}</a></td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td class="users-view-email">{{ $feedback->atc->user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="mb-1"><i class="ft-link"></i>Información Feedback</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Rating:</td>
                                    <td class="users-view-username"><x-rating :rating="$feedback->rating"/></td>
                                </tr>
                                <tr>
                                    <td>Mensaje:</td>
                                    <td class="users-view-name">{{ $feedback->message }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->
    </section>
@endsection
