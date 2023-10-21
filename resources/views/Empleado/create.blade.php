formulario de creación de empleado
@extends('layouts.app')

@section('content')
<div class="container">
<br><br>
<form action="{{url('/Empleado')}}" method="post" enctype="multipart/form-data"> 
    @csrf
    @include("Empleado.form",['modo'=>'Crear'])
</form>
</div>
@endsection
