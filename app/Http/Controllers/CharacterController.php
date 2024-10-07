<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::all();
    
        // Invia i dati alla vista 'caratters.index'
        return view('characters.index', compact('characters'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("characters.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Crea un nuovo personaggio con i dati dal modulo
        $character = Character::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'strength' => $request->input('strength'),
            'defence' => $request->input('defence'),
            'speed' => $request->input('speed'),
            'intelligence' => $request->input('intelligence'),
            'life' => $request->input('life'),
            'type_id' => $request->input('type_id'),
        ]);

       
        // Reindirizza alla pagina index con un messaggio di successo
        return redirect()->route('characters.index');

    }
    




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $character = Character::find($id);  

       return view ('characters.show', compact ('character') ) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $character = Character::find($id);

        return view('characters.edit', compact('character'));
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
        $character = Character::find($id);

        $character->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'strength' => $request->input('strength'),
            'defence' => $request->input('defence'),
            'speed' => $request->input('speed'),
            'intelligence' => $request->input('intelligence'),
            'life' => $request->input('life'),
            'type_id' => $request->input('type_id'),
        ]);

        return redirect()->route('characters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $character = Character::find($id);

        $character->delete();

        return redirect()->route('characters.index');
    }
}