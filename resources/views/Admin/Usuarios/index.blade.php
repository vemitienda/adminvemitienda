@extends('layouts.adminlte.index')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $activos }}</h3>
                    <p>Usuarios Activos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
    </div>

    <x-TablaDatos :data="@$data" resource='usuarios' edit="true" />
@endsection
