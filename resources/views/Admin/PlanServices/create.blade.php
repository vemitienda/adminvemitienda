@extends('layouts.adminlte.index')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h5 class="text-default"><i class="fa fa-user-circle"></i> Crear Plan - Servicios</h5>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('planservices.index') }}" class="btn btn-dark btn-xs">Cancelar</a>
            </div>
        </div>
    </div>
    {{ Session::get('errors') }}
    <div class="card-body">
        <form action="{{ route('planservices.store') }}" method="POST">
            @csrf()
            <div class="card-body">
                <div class="row">
                    <x-select name="plan_id" columns="4" label="Plan" required="true" required="true"
                        :datos="@$plans" />

                    <x-multiselect required="true" id="servicio_id" name="services[]" columns="8" label="Servicios" multiple="true"
                        class="select2" placeholder="Click aquí para seleccionar los servicios" :datos="@$services" />
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn-sm btn btn-dark float-right"><i class="fa fa-save"></i>
                    Guardar</button>
            </div>
        </form>
    </div>

</div>
@endsection
