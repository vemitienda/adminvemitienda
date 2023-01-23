@extends('layouts.adminlte.index')
@section('content')

<x-TablaDatos :data="@$data" resource='usuarios' edit="true"/>

@endsection
