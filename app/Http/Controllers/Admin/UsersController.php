<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsuarioRequest;
use App\Models\PlanUser;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filtrar = request()->get('query');

        $datos['infoData'] = User::withCount('Products')
            ->when($filtrar, function ($q) use ($filtrar) {
                $q->where('name', 'like', '%' . $filtrar . '%');
                $q->orWhere('email', 'like', '%' . $filtrar . '%');
                return $q;
            })
            ->orderBy('id', 'desc')
            ->paginate(9);

        $data['total'] = User::count();

        $data['verificados'] = User::query()
            ->where('email_verified_at', '>', '2000-01-01 00:00:00')
            ->count();

        $data['sinVerificar'] = User::query()
            ->where('email_verified_at', null)
            ->count();

        $data['planActivo'] = PlanUser::where('plan_id', '>', 1)->count();


        $data['totalProductos'] = Product::count();

        $data['usuariosConProductos'] = Product::groupBy('user_id')->get()->count();

        $datos['nombreColumnas'] = collect([
            'Nombre' => 'name',
            'Email' => 'email',
            'n° Productos' => 'products_count',
            'Alta' => 'created_at',
            'Verificado' => 'email_verified_at'
        ]);

        $datos['token'] = csrf_token();

        $data['data'] = $datos;

        return view('Admin.Usuarios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $insert = request()->all();
        $insert['password'] = Hash::make(request()->password);
        $user = User::create($insert);
        $user->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Admin.Usuarios.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['usuario'] = User::find($id);
        return view('Admin.Usuarios.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        $user = User::find($id);
        $user->name        = request()->name;
        $user->email       = request()->email;

        if (!is_null(request()->password)) {
            $user->password = request()->password;
        }

        $user->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('usuarios.index');
    }
}
