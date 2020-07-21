<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Componente;

class Componentes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $componentes = Componente::all();

        return view('componente.index', compact(['componentes']));
    }

    public function store(Request $request)
    {
        $novo = new Componente();
        $novo->nome = $request->input('nome');
        $novo->carga_horaria = $request->input('carga_horaria');
        $novo->curso_id = $request->input('curso');
        $novo->save();

        return json_encode($novo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $componente = Componente::findOrFail($id);
        if(isset($componente)) {
            return json_encode($componente);
        }
        return response('Componente nao encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $componente = Componente::findOrFail($id);
        if(isset($componente)) {
            $componente->nome = $request->input('nome');
            $componente->carga_horaria = $request->input('carga_horaria');
            $componente->curso_id = $request->input('curso');
            $componente->save();

            return json_encode($componente);
        }
        return response('Componente nao encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
