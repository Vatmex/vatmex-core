
@extends('templates.page')

@section('title', 'Staff')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="#">Nosotros</a></li>
        <li class="active"><a href="{{ url('/about/staff') }}">Staff</a></li>
    </ul>
@endsection

@section('content')
    @foreach ($teams as $team)
        <div class="heading-text heading-section text-center">
            <h2>{{ $team->name }}</h2>
            <span>{{ $team->description }}</span>
        </div>
        <div class="row team-members m-b-40">
            @foreach ($team->staff as $staff)
                <div class="col-lg-3">
                    <div class="team-member">
                        <div class="team-image">
                            <img src="https://www.gravatar.com/avatar/205e460b479e2es5b48aec07710c08d50?s=525">
                        </div>
                        <div class="team-desc">
                            <h3>{{ ($staff->user) ? $staff->user->name : 'Vacante'; }}</h3>
                            <span>{{ $staff->position }}</span><br>
                            <span>{{ ($staff->user) ? $staff->email : 'Vacante' }}</span>
                            <p>{{ $staff->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
