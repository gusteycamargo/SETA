<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplina;

class Disciplinas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplinas = Disciplina::all();

        return view('disciplina.index', compact(['disciplinas']));
    }

    public function store(Request $request)
    {
        $novo = new Disciplina();
        $novo->nome = $request->input('nome');
        $novo->num_de_bimestres = $request->input('num_de_bimestres');
        $novo->componente_id = $request->input('componente_id');
        $novo->turma_id = $request->input('turma');
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
        $disciplina = Disciplina::findOrFail($id);
        if(isset($disciplina)) {
            return json_encode($disciplina);
        }
        return response('Disciplina nao encontrada', 404);
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
        $disciplina = Disciplina::findOrFail($id);
        if(isset($disciplina)) {
            $disciplina->nome = $request->input('nome');
            $disciplina->num_de_bimestres = $request->input('num_de_bimestres');
            $disciplina->componente_id = $request->input('componente_id');
            $disciplina->turma_id = $request->input('turma');
            $disciplina->save();

            return json_encode($disciplina);
        }
        return response('Disciplina nao encontrada', 404);
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
