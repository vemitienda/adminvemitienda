@extends('layouts.adminlte.index')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h5 class="text-default"><i class="fa fa-user-circle"></i> Asignar Plan a Usuario</h5>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('planusers.index') }}" class="btn btn-dark btn-xs">Cancelar</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('planusers.store') }}" method="POST">
            @csrf()
            <div class="card-body">
                <div class="row">
                    <x-select columns=7 label="Usuario" required=true name="user_id" :datos="@$users" />
                    <x-select columns=3 label="Plan" required=true name="plan_id" :datos="@$plans" />
                    <x-select columns=2 label="Activo" required=true name="activo" :datos="@$activo" selected="1" />
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
