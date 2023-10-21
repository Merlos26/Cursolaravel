<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados']= Empleado::paginate(1);
        return view("Empleado.index", $datos); //accede a la vista index

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("Empleado.create"); //accede a la vista create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);


        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if ($request->hasFile('foto')) {
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');
        }

        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado);
        return redirect('Empleado')->with('mensaje','Empleado agregado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        
        $empleado=Empleado::findOrfail($id);
        return view("Empleado.edit", compact('empleado')); //accede a la vista edit, la funcion compact sirve para enviar todos los datos
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email'
            
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido'
           
        ];

        if ($request->hasFile('foto')) {//aqui se valida la foto por si quiere subir una nueva
            $campos=['foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['foto.required'=>'La foto es requerida' ]; 
        }

        $this->validate($request,$campos,$mensaje);


        $datosEmpleado = request()->except(['_token','_method']);
        if ($request->hasFile('foto')) {
            $empleado=Empleado::findOrfail($id);
            Storage::delete('public/'.$empleado->foto);
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');
        }


        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrfail($id);
        //return view("Empleado.edit", compact('empleado'));
        return redirect('Empleado')->with('mensaje','Empleado modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrfail($id);
        if(Storage::delete('public/'.$empleado->foto))
        {
            Empleado::destroy($id);
        }
        
        return redirect('Empleado')->with('mensaje','Empleado borrado con exito');
    }
}
