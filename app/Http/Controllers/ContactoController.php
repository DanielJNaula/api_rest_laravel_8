<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactoRequest;
use App\Http\Requests\UpdateContactoRequest;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('txtBuscar')) {
            $directorios = Contacto::where('nombre', 'like', '%' . $request->txtBuscar . '%')
                ->orWhere('telefono', 'like', '%' . $request->txtBuscar . '%')
                ->get();
        } else {
            $directorios = Contacto::get();
        }
        return $directorios;
    }

    private function cargarArchivo($file)
    {
        $nombreArchivo = time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('fotografias'), $nombreArchivo);
        return $nombreArchivo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactoRequest $request)
    {
        $input = $request->all();

        if ($request->has('foto')) {
            $input['foto'] = $this->cargarArchivo($request->foto);
        }

        Contacto::create($input);

        return response()->json([
            'res'     => true,
            'message' => 'Registro creado correctamente',

        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        return $contacto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactoRequest $request, Contacto $contacto)
    {
        $input = $request->all();

        if ($request->has('foto')) {
            $input['foto'] = $this->cargarArchivo($request->foto);
        }

        $contacto->update($input);
        return response()->json([
            'res'     => true,
            'message' => 'Registro actualizado correctamente',

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contacto::destroy($id);
        return response()->json([
            'res'     => true,
            'message' => 'Registro eliminado correctamente',

        ], 200);
    }
}
