<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanUserRequest;
use App\Models\Plan;
use App\Models\PlanUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanUsersController extends Controller
{

    private $activo;

    public function __construct()
    {
        $this->activo = [
            (object)['id' => 1, 'label' => 'Si'],
            (object)['id' => 0, 'label' => 'No']
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

        $datos['infoData'] = PlanUser::select([
            'plan_users.id',
            'users.email as user',
            'plans.name as plan',
            DB::raw("if(plan_users.activo=1,'Si','No') as activo"),
        ])
            ->leftJoin('plans', 'plan_users.plan_id', '=', 'plans.id')
            ->leftJoin('users', 'plan_users.user_id', '=', 'users.id')
            ->orderBy('id', 'desc')
            ->groupBy('user') //Para usar esto, se colocó 'strict' => false en config/database.php
            ->paginate(9);

        $datos['nombreColumnas'] = collect([
            'User'   => 'user',
            'Plan'   => 'plan',
            'Activo' => 'activo',
        ]);

        $datos['token'] = csrf_token();

        $data['data'] = $datos;

        return view('Admin.PlanUsers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users']  = User::select('id', DB::raw("CONCAT(name, ' ', email) as label"))->get();
        $data['plans']  = Plan::select('id', 'name as label')->get();
        $data['activo'] = $this->activo;
        return view('Admin.PlanUsers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanUserRequest $request)
    {
        $planUser = PlanUser::create(request()->all());
        $planUser->save();
        return redirect()->route('planusers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $planUser = PlanUser::find($id);
        $datos['infoData'] = PlanUser::select([
            'plan_users.id',
            'users.email as user',
            'plans.name as plan',
            'plan_users.created_at',
            'payments.start_date',
            'payments.end_date',
            DB::raw("if(plan_users.activo=1,'Si','No') as activo"),
        ])
            ->leftJoin('plans', 'plan_users.plan_id', '=', 'plans.id')
            ->leftJoin('users', 'plan_users.user_id', '=', 'users.id')
            ->leftJoin('payments', 'users.id', '=', 'payments.user_id')
            ->where('plan_users.user_id', $planUser->user_id)
            ->orderBy('plan_users.id', 'desc')
            ->get();

        $datos['nombreColumnas'] = collect([
            'User'   => 'user',
            'Plan'   => 'plan',
            'Activo' => 'activo',
            'Inicio' => 'start_date',
            'Fin'    => 'end_date',
        ]);

        $datos['token'] = csrf_token();

        $data['data'] = $datos;

        return view('Admin.PlanUsers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users']    = User::select('id', DB::raw("CONCAT(name, ' ', email) as label"))->get();
        $data['plans']    = Plan::select('id', 'name as label')->get();
        $data['activo']   = $this->activo;
        $data['planuser'] = PlanUser::with('user', 'plan')->find($id);
        return view('Admin.PlanUsers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanUserRequest $request, $id)
    {
        $planUser          = PlanUser::find($id);
        $planUser->user_id = request()->user_id;
        $planUser->plan_id = request()->plan_id;
        $planUser->activo  = request()->activo;
        $planUser->save();

        return redirect()->route('planusers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planUser = PlanUser::find($id);
        $planUser->delete();
        return redirect()->route('planusers.index');
    }
}
