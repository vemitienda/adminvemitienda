@extends('layouts.adminlte.index')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h5 class="text-default"><i class="fa fa-user-circle"></i> Crear Pago de Plan</h5>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('payments.index') }}" class="btn btn-dark btn-xs">Cancelar</a>
            </div>
        </div>
    </div>
    {{ Session::get('errors') }}
    <div class="card-body">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf()
            <div class="card-body">
                <div class="row">
                    <x-select columns=6 label="Usuario" required=true name="user_id" :datos="@$users" />
                    <x-select columns=3 label="Plan" required=true name="plan_id" :datos="@$plans" />
                    <x-select columns=3 label="Pagado" required=true name="paid_out" :datos="@$pagado" />
                    <x-text type="date" columns=3 label='Inicio' required="true" name="start_date" />
                    <x-text type="date" columns=3 label='Fin' required="true" name="end_date" />
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
