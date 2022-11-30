<?php

namespace App\Http\Controllers;

use App\Models\Perro;
use Illuminate\Http\Request;

class PerroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Perros = Perro::all(['id','raza','imagen','tamaño','pelo','color','origen','observaciones']);
        return response()->json($Perros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Perro = Perro::create($request->post());
        return response()->json([           
            'Perro'=>$Perro
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perro  $Perro
     * @return \Illuminate\Http\Response
     */
    public function show(Perro $Perro)
    {
        return response()->json($Perro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perro  $Perro
     * @return \Illuminate\Http\Response
     */
    public function edit(Perro $Perro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perro  $Perro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perro $Perro)
    {
        $Perro->fill($request->post())->save();
        return response()->json([            
            'Perro'=>$Perro
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perro  $Perro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perro $Perro)
    {
        $Perro->delete();
        return response()->json([
            'mensaje'=>'¡Registro eliminado correctamente!'
        ]);
    }
}
