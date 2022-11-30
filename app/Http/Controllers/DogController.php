<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $Dogs = Dog::all(['id','raza','imagen','tamaño','pelo','color','origen','observaciones']);
        return response()->json($Dogs);
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
        if($request->hasFile('imagen')){
            $filename=$request->imagen->getClientOriginalName();
            info(message:$filename);
        }
        $Dog = Dog::create($request->post());
        return response()->json([           
            'Dog'=>$Dog
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dog  $Dog
     * @return \Illuminate\Http\Response
     */
    public function show(Dog $Dog)
    {
        return response()->json($Dog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dog  $Dog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dog $Dog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dog  $Dog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dog $Dog)
    {
        $Dog->fill($request->post())->save();
        return response()->json([            
            'Dog'=>$Dog
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dog  $Dog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dog $Dog)
    {
        $Dog->delete();
        return response()->json([
            'mensaje'=>'¡Registro eliminado correctamente!'
        ]);
    }
}
