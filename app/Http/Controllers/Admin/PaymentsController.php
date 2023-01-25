<?php

namespace App\Http\Controllers\Admin;

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
        $planUsers = PlanUser::query()
            ->where('user_id', request()->user_id)
            ->where('plan_id', request()->plan_id)
            ->where('activo', 1)
            ->orderBy('id', 'desc')
            ->first();

        if (@$planUsers) { //Hago el pago sobre este campo, sino creo uno nuevo

            $payment = Payment::create([
                'plan_user_id' => $planUsers->id,
                'start_date' => request()->start_date,
                'end_date' => request()->end_date,
                'paid_out' => request()->paid_out
            ]);

            $payment->save();

            return redirect()->route('payments.index');
        } else { // debo crear el plan al usuario y asignar el pago.
            // Esta situación pasará cuando un usuario quiere pagar antes del vencimiento del plan

            $planUser = PlanUser::create([
                'plan_id' => request()->plan_id,
                'user_id' => request()->user_id,
                'activo' => 1
            ]);

            $planUser->save();

            $payment = Payment::create([
                'plan_user_id' => $planUser->id,
                'start_date' => request()->start_date,
                'end_date' => request()->end_date,
                'paid_out' => request()->paid_out
            ]);

            return redirect()->route('payments.index');
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