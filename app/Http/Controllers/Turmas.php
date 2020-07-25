<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;

class Turmas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = Turma::all();

        return view('turma.index', compact(['turmas']));
    }

    public function store(Request $request)
    {
        $novo = new Turma();
        $novo->nome = $request->input('nome');
        $novo->ano = $request->input('ano');
        $novo->abreviatura = $request->input('abreviatura');
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
        $turma = Turma::findOrFail($id);
        if(isset($turma)) {
            return json_encode($turma);
        }
        return response('Turma nao encontrado', 404);
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
        $turma = Turma::findOrFail($id);
        if(isset($turma)) {
            $turma->nome = $request->input('nome');
            $turma->ano = $request->input('ano');
            $turma->abreviatura = $request->input('abreviatura');
            $turma->curso_id = $request->input('curso');
            $turma->save();

            return json_encode($turma);
        }
        return response('Turma nao encontrado', 404);
    }

    public function loadJson() {
        $turmas = Turma::all();
        return json_encode($turmas);
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
