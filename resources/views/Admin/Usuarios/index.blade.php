@extends('layouts.adminlte.index')
@section('content')
    <div class="row">
        <div class="col-md-4 small-box bg-success" style="margin: 10px">
            <div class="inner">
                <h3>{{ $activos }}</h3>
                <p>Usuarios Activos</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>

        <div class="col-md-4 small-box bg-info" style="margin: 10px">
            <div class="inner">
                <h3>{{ $totalProductos }}</h3>
                <p>Total de productos</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
    </div>

    <x-TablaDatos :data="@$data" resource='usuarios' edit="true" />
@endsection
