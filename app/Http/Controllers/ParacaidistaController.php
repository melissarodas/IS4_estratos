<?php

namespace App\Http\Controllers;

use App\Models\Paracaidista;
use Illuminate\Http\Request;

class ParacaidistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paracaidistas = Paracaidista::orderBy('id','desc')->get();
        return $paracaidistas;
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
        $paracaidista = new Paracaidista;
        $paracaidista->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paracaidista  $paracaidista
     * @return \Illuminate\Http\Response
     */
    public function show(Paracaidista $paracaidista)
    {
        return $paracaidista;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paracaidista  $paracaidista
     * @return \Illuminate\Http\Response
     */
    public function edit(Paracaidista $paracaidista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paracaidista  $paracaidista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paracaidista $paracaidista)
    {
        $paracaidista->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paracaidista  $paracaidista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paracaidista $paracaidista)
    {
        $paracaidista->delete();
    }
}
