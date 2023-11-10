
@extends('templates.page')

@section('title', 'Roster')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="#">Nosotros</a></li>
        <li class="active"><a href="{{ route('about.roster') }}">Roster</a></li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>CID</th>
                        <th>Nombre</th>
                        <th>Iniciales</th>
                        <th>Estado</th>
                        <th>Rango</th>
                        <th>DEL</th>
                        <th>GND</th>
                        <th>TWR</th>
                        <th>APP</th>
                        <th>CTR</th>
                        <th>FIR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($atcs as $atc)
                        <tr>
                            <td>{{ $atc->user->cid }}</td>
                            <td>{{ $atc->user->name}}</td>
                            <td>{{ $atc->initials}}</td>
                            <td>{!! ($atc->inactive) ? '<span class="badge badge-pill bg-danger">Inactivo</span>' : '<span class="badge badge-pill bg-success">Activo</span>';!!}</td>
                            <td><x-rank :rank="$atc->rank"/></td>
                            <td>{!! ($atc->delivery) ? '<span class="badge badge-pill bg-success"><i class="icon-thumbs-up"> </i></span>' : '<span class="badge badge-pill bg-danger"><i class="icon-thumbs-down"> </i></span>';!!}</td>
                            <td>{!! ($atc->ground) ? '<span class="badge badge-pill bg-success"><i class="icon-thumbs-up"> </i></span>' : '<span class="badge badge-pill bg-danger"><i class="icon-thumbs-down"> </i></span>';!!}</td>
                            <td>{!! ($atc->tower) ? '<span class="badge badge-pill bg-success"><i class="icon-thumbs-up"> </i></span>' : '<span class="badge badge-pill bg-danger"><i class="icon-thumbs-down"> </i></span>';!!}</td>
                            <td>{!! ($atc->approach) ? '<span class="badge badge-pill bg-success"><i class="icon-thumbs-up"> </i></span>' : '<span class="badge badge-pill bg-danger"><i class="icon-thumbs-down"> </i></span>';!!}</td>
                            <td>{!! ($atc->center) ? '<span class="badge badge-pill bg-success"><i class="icon-thumbs-up"> </i></span>' : '<span class="badge badge-pill bg-danger"><i class="icon-thumbs-down"> </i></span>';!!}</td>
                            <td>{!! ($atc->supercenter) ? '<span class="badge badge-pill bg-success"><i class="icon-thumbs-up"> </i></span>' : '<span class="badge badge-pill bg-danger"><i class="icon-thumbs-down"> </i></span>';!!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- end: DataTable -->
@endsection

@section('page-js')
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                pageLength: 25,
                columnDefs: [
                    { "type": "num", "targets": 0 }
                ],
            });
        });
    </script>
@endsection
