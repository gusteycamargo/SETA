<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peso;

class Pesos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $novo = new Peso();
        $novo->avaliacao = $request->input('avaliacao');
        $novo->trabalho = $request->input('trabalho');
        $novo->pri_bim = $request->input('pri_bim');
        $novo->seg_bim = $request->input('seg_bim');
        $novo->ter_bim = $request->input('ter_bim');
        $novo->qua_bim = $request->input('qua_bim');
        $novo->disciplina_id = $request->input('disciplina_id');
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
        $peso = Peso::where('disciplina_id', $id)->firstOrFail();
        if(isset($peso)) {
            return json_encode($peso);
        }
        return response('Peso nao encontrado', 404);
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
        $novo = Peso::where('disciplina_id', $id)->firstOrFail();
        if(isset($novo)) {
            $novo->avaliacao = $request->input('avaliacao');
            $novo->trabalho = $request->input('trabalho');
            $novo->pri_bim = $request->input('pri_bim');
            $novo->seg_bim = $request->input('seg_bim');
            $novo->ter_bim = $request->input('ter_bim');
            $novo->qua_bim = $request->input('qua_bim');
            $novo->disciplina_id = $request->input('disciplina_id');
            $novo->save();

            return json_encode($novo);
        }
        return response('Peso nao encontrado', 404);
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
