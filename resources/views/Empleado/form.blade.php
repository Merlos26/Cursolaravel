
    
    <h1>Formulario {{ $modo}}</h1>

    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                 @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        
    @endif



    <div class="form-group">
    <label for="Nombre">    Nombre</label>
    <input type="text" class="form-control" name="Nombre" 
    value="{{isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" id="Nombre"> 
    </div>
     

    <div class="form-group">
    <label for="ApellidoPaterno">   ApellidoPaterno</label>
    <input type="text" class="form-control" name="ApellidoPaterno" 
    value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}" 
    id="ApellidoPaterno">
    </div>
     

    <div class="form-group">
    <label for="ApellidoMaterno">   ApellidoMaterno</label>
    <input type="text" class="form-control" name="ApellidoMaterno" 
    value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}"
     id="ApellidoMaterno">
    </div>
     

    <div class="form-group">
    <label for="Correo">    Correo</label>
    <input type="text" class="form-control" name="Correo" 
    value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" id="Correo">
    </div>
     
    <br>
    <div class="form-group">
    <label for="foto"> </label>
   
    @if(isset($empleado->foto))
    <br>
    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->foto}}" width="100" alt="">
    @endif
    <input type="file" class="form-control" name="foto" value="" id="foto">
    </div>
     <br>

 
    <input type="submit" class="btn btn-success" value="{{ $modo }} datos">

    <a class="btn btn-primary" href="{{ url('Empleado/')}}" class="form-control">Regresar</a>

     