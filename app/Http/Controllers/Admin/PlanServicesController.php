<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filtrar = request()->get('query');

        $datos['infoData'] = PlanService::select([
            'plan_services.id as id',
            'plans.name as plan',
            DB::raw("CONCAT(services.quantity,' ',services.name) as services")
        ])
            ->leftJoin('plans', 'plan_services.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'plan_services.service_id', '=', 'services.id')
            ->paginate(9);

        $datos['nombreColumnas'] = collect([
            'Plan'   => 'plan',
            'Servicios' => 'services'
        ]);

        $datos['token'] = csrf_token();

        $data['data'] = $datos;

        return view('Admin.PlanServices.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['plans']    = Plan::select('id', 'name as label')->get();
        $data['services'] = Service::select('id', DB::raw("CONCAT(quantity,' ',name) as label"))->get();
        return view('Admin.PlanServices.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan_id = request()->plan_id;
        foreach (request()->services as $value) {
            $planServices   = PlanService::create([
                'plan_id' => $plan_id,
                'service_id' => $value
            ]);
            $planServices->save();
        }
        return redirect()->route('planservices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Admin.PlanServices.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($plan_id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanServiceRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ps = PlanService::find($id);
        $ps->delete();

        return redirect()->route('planservices.index');
    }
}
