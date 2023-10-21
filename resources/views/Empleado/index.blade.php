@extends('layouts.app')

@section('content')
<div class="container">
    
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    



<a href="{{ url('Empleado/create')}}" class="btn btn-success">Registrar nuevo Empleado</a>
<br><br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <!--//foreach en blade !-->
        @foreach($empleados as $empleado) 
        <tr>
            <td>{{$empleado->id}}</td> <!--//instuccion en blade !-->
            <td>
                <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->foto}}" width="100" alt="">
                {{$empleado->Foto}}
            </td>


            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>
                <a href="{{url('/Empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">Editar</a>
             | 

            <form action="{{url('/Empleado/'.$empleado->id)}}" class="d-inline" method="post">
                @csrf
                {{method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres borrar?')" value="Borrar">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection