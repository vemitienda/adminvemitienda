<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Fechas;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentRequest;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{

    private $pagado;

    public function __construct()
    {
        $this->pagado = [
            (object)['id' => 1, 'label' => 'Pagado'],
            (object)['id' => 0, 'label' => 'Por Pagar']
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filtrar = request()->get('query');

        $datos['infoData'] = Payment::select([
            'payments.id',
            'users.email',
            'plans.name as plan',
            'payments.start_date as inicio',
            'payments.end_date as fin',
            DB::raw("if(paid_out=1,'Pagado','...') as pagado")
        ])
            ->leftJoin('plan_users', 'payments.plan_user_id', '=', 'plan_users.id')
            ->leftJoin('users', 'plan_users.user_id', '=', 'users.id')
            ->leftJoin('plans', 'plan_users.plan_id', '=', 'plans.id')
            ->paginate(9);

        $datos['token'] = csrf_token();

        $data['data'] = $datos;

        return view('Admin.Payments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::select('id', 'email as label')->get();
        $data['plans'] = Plan::select('id', 'name as label')->get();
        $data['pagado'] = $this->pagado;
        return view('Admin.Payments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $user_id = request()->user_id;
        $months = request()->months;
        $pagado = 1;
        $premium = Plan::where('name', 'Plan Premium')->first();
        $plan_id = $premium->id;
        // buscar si el usuario tiene un plan activo
        $planActivo = PlanUser::query()
            ->where('user_id', $user_id)
            ->where('activo', 1)
            ->first();

        if (!is_null($planActivo)) {
            //la fecha de inicio será un día después del último pago y a partir de ahí se calcula la fecha de fin
            $ultimoPago = Payment::where('user_id', $user_id)->where('pagado', 1)->orderBy('id', 'desc')->first();
            $fechaInicio = Carbon::parse($ultimoPago->end_date)->addDays(1)->format('Y-m-d') . ' 00:00:00';
            $fechaFin = $fechaInicio->addMonths($months)->format('Y-m-d') . ' 23:59:59';
            $payment=Payment::create([

            ]);
        } else {
            //la fecha de inicio será la fecha actual y a partir de ahí se calcula la fecha de fin
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users'] = User::select('id', 'email as label')->get();
        $data['plans'] = Plan::select('id', 'name as label')->get();
        $data['pagado'] = $this->pagado;

        $data['payment'] = Payment::select([
            'payments.id as id',
            'users.id as user_id',
            'plans.id as plan_id',
            DB::raw("DATE_FORMAT(payments.start_date,'%d-%m-%Y') as inicio"),
            DB::raw("DATE_FORMAT(payments.end_date,'%d-%m-%Y') as fin"),
            'paid_out as pago'
        ])
            ->leftJoin('plan_users', 'payments.plan_user_id', '=', 'plan_users.id')
            ->leftJoin('users', 'plan_users.user_id', '=', 'users.id')
            ->leftJoin('plans', 'plan_users.plan_id', '=', 'plans.id')
            ->where('payments.id', $id)
            ->first();

        return view('Admin.Payments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $payment             = Payment::find($id);
        $payment->paid_out   = request()->paid_out;
        $payment->start_date = Carbon::parse(request()->start_date . ' 00:00:00')->format('Y-m-d H:i:s');
        $payment->end_date   = Carbon::parse(request()->end_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $payment->save();

        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pay = Payment::find($id);
        $pay->delete();
        return redirect()->route('payments.index');
    }
}
