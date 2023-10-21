@extends('layouts.app')

@section('content')
<h1>Nuevo cambio</h1>
<div class="container">

<form action="{{url('/Empleado/'.$empleado->id)}}" method="post" enctype="multipart/form-data">
@csrf

{{method_field('PATCH')}}
@include("Empleado.form",['modo'=>'Editar'])
</form>

</div>
@endsection
