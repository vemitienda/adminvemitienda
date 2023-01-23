@extends('layouts.adminlte.index')
@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center" style="display: none" id="box-loader">
                    <img width="200px" height="200px"
                        src="{{ asset('img/loader.gif') }}"
                        class="img-circle elevation-2 avatarImage" alt="User Image">
                </div>
                <div class="text-center" id="box-avatar">
                    
                    <img width="200px" height="200px"
                        
                        src="{{ $imagen ? env('DO_URL_BASE').$imagen : asset('img/avatar.png') }}"
                        class="img-circle elevation-2 avatarImage" alt="User Image">
                </div>

                <h3 class="profile-username text-center">{{ $usuario->name }}</h3>
                
                <p class="text-muted text-center">{{ $usuario->roles[0]->name }}</p>

                <button type="button" href="#" class="btn btn-dark btn-block avatarImage" ><b>Cambiar
                        Foto</b></button>

                <form action="{{ url('/api/subir/avatar') }}" id="avatarForm">
                    {{ csrf_field() }}
                    <input type="file" name="imagen" style="display:none" id="avatarInput">
                    <input type="hidden" name="users_id" id="users_id" value="{{ $usuario->id }}">
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-default"><i class="fa fa-user-circle"></i> Editar mis datos</h5>
                    </div>
                    <div class="col-6 text-right">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('misdatos.update',$usuario) }}" method="POST">
                    @csrf()
                    <input type="hidden" name="_method" value="put">
                    <div class="card-body">
                        <div class="row">
                            <x-text name="name" columns="6" label="Nombre Completo" required="true"
                                placeholder="Ingrese su nombre aquí..." value="{{ $usuario->name }}" />
                            <x-text name="email" columns="6" type="email" label="Correo electrónico" required="true"
                                placeholder="Ingrese su correo aquí..." value="{{ $usuario->email }}" />
                            <x-text name="password" columns="6" type="password" label="Contraseña"
                                small="Deje la contraseña en blanco si no desea cambiarla"
                                placeholder="Ingrese su contraseña aquí..." />
                            <x-text name="password_confirmation" columns="6" type="password"
                                label="Repita su contraseña" placeholder="Ingrese su contraseña aquí..."
                                small="Deje la contraseña en blanco si no desea cambiarla" />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark float-right"><i class="fa fa-save"></i>
                            Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection