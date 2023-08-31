@extends('layouts.adminlte.index')
@section('content')
    <h3>Totales</h3>
    <div class="row">

        <div class="col-md-3">
            <x-cardDashboard title="Usuarios totales" number="{{ $usuariosTotales }}" />
        </div>

        <div class="col-md-3">
            <x-cardDashboard title="Productos totales" number="{{ $productosTotales }}" />
        </div>

        <div class="col-md-3">
            <x-cardDashboard title="Visitas" number="{{ $visits }}" />
        </div>

    </div>

    <hr />

    <h3>Reales</h3>
    <div class="row">
        <div class="col-md-3">
            <x-cardDashboard title="Total usuarios" number="{{ $totalUsuariosReales }}" />
        </div>

        <div class="col-md-3">
            <x-cardDashboard title="Total productos" number="{{ $totalProductosReales }}" />
        </div>

        <div class="col-md-3">
            <x-cardDashboard title="Usuarios con productos" number="{{ $usuariosRealesConProductos }}" />
        </div>
    </div>


    <x-TablaDatos :data="@$data" resource='usuarios' edit="true" />
@endsection
