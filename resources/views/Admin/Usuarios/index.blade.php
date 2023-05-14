@extends('layouts.adminlte.index')
@section('content')
    <div class="row">

        <div class="col-md-4">
            <div class="small-box bg-success" style="padding: 10px">
                <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Usuarios</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-info" style="padding: 10px">
                <div class="inner">
                    <h3>{{ $totalProductos }}</h3>
                    <p>Productos en total</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success" style="padding: 10px">
                <div class="inner">
                    <h3>{{ $usuariosConProductos }}</h3>
                    <p>Usuarios con Productos</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-info" style="padding: 10px">
                <div class="inner">
                    <h3>{{ $verificados }}</h3>
                    <p>Usuarios verificados</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success" style="padding: 10px">
                <div class="inner">
                    <h3>{{ $sinVerificar }}</h3>
                    <p>Usuarios no verificados</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-info" style="padding: 10px">
                <div class="inner">
                    <h3>{{ $planActivo }} <span style="font-size:16px">(Usuarios reales)</span></h3>
                    <p>Usuarios con plan de pago activo</p>
                </div>
            </div>
        </div>

    </div>


    <x-TablaDatos :data="@$data" resource='usuarios' edit="true" />
@endsection
