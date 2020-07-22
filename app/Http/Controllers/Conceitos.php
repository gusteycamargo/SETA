<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conceito;

class Conceitos extends Controller
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
        $novo = new Conceito();
        $novo->a = $request->input('a');
        $novo->b = $request->input('b');
        $novo->c = $request->input('c');
        $novo->d = $request->input('d');
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
        $conceito = Conceito::where('disciplina_id', $id)->firstOrFail();
        if(isset($conceito)) {
            return json_encode($conceito);
        }
        return response('Conceito nao encontrado', 404);
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
        $novo = Conceito::where('disciplina_id', $id)->firstOrFail();
        if(isset($novo)) {
            $novo->a = $request->input('a');
            $novo->b = $request->input('b');
            $novo->c = $request->input('c');
            $novo->d = $request->input('d');
            $novo->disciplina_id = $request->input('disciplina_id');
            $novo->save();

            return json_encode($novo);
        }
        return response('Conceito nao encontrado', 404);
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
