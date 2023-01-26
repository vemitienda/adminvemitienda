@extends('layouts.adminlte.index')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h5 class="text-default"><i class="fa fa-user-circle"></i> Crear Plan</h5>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('plans.index') }}" class="btn btn-dark btn-xs">Cancelar</a>
            </div>
        </div>
    </div>
{{ Session::get('errors') }}
    <div class="card-body">
        <form action="{{ route('plans.store') }}" method="POST">
            @csrf()
            <div class="card-body">
                <div class="row">
                    <x-text name="name" columns="6" label="Nombre del Plan" required="true"
                        placeholder="Ingrese su plan aquí..." />
                    <x-text type="number" name="quantity" columns="6" label="Cantidad de productos" required="true"
                        placeholder="Ingrese la cantidad de productos aquí..." />
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn-sm btn btn-dark float-right"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>

</div>
@endsection
