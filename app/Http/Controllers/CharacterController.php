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
    // Validazione dei dati
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required|min:10',
        'strenght' => 'required|integer|min:1',
        'defence' => 'required|integer|min:1',
        'speed' => 'required|integer|min:1',
        'intelligence' => 'required|integer|min:1',
        'life' => 'required|integer|min:1',
        'type_id' => 'required|exists:types,id', // Assicurati che il type_id esista nella tabella types
    ]);

    // Creazione di un nuovo oggetto Character
    $new_character = new Character();
    $new_character->fill($validatedData);

    // Salvataggio del personaggio
    $new_character->save();

    // Reindirizzamento alla lista dei personaggi con messaggio di successo
    return redirect()->route('characters.index')->with('success', 'Personaggio aggiunto con successo!');
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