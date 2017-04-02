<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;

class Cargar extends Controller

{
    public function login(){
        return view('login');
    }
    public function apuesta(){
        return view('apuesta');
    }
    public function index()
    {
        /// Producir los pares

        $aux='0';
        for ($i=0; $i <100 ; $i++)
         { 
            if ($i<10) 
            {
                 $insercion=DB::table('pares')->insert
                (['valor'=>$aux.(string)$i]);
            }
            else
            {
                 $insercion=DB::table('pares')->insert
                (['valor'=>(string)$i]);
            }
           
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
