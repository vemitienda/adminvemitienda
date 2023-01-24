@extends('layouts.adminlte.index')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h5 class="text-default"><i class="fa fa-user-circle"></i> Editar Pago de Plan</h5>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('payments.index') }}" class="btn btn-dark btn-xs">Cancelar</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('payments.update',$payment) }}" method="POST">
            @csrf()
            <input type="hidden" name="_method" value="put">
            <div class="card-body">
                <div class="row">
                    <x-select disabled :selected="$payment->user_id" columns=6 label="Usuario" required=true name="user_id"
                        :datos="@$users" />

                    <x-select disabled :selected="$payment->plan_id" columns=3 label="Plan" required=true name="plan_id"
                        :datos="@$plans" />

                    <x-select :selected="$payment->pago" columns=3 label="Pagado" required=true name="paid_out"
                        :datos="@$pagado" />

                    <x-text class="datepicker" value="{{ $payment->inicio }}" type="text" columns=3 label='Inicio'
                        required="true" name="start_date" />

                    <x-text class="datepicker" value="{{ $payment->fin }}" type="text" columns=3 label='Fin' required="true"
                        name="end_date" />
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-dark float-right"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
$('.datepicker').datepicker({
format: 'mm/dd/yyyy',
startDate: '-3d'
});
</script>
@endsection
