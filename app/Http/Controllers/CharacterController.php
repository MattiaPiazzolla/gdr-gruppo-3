<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Item; 
use App\Models\Type;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $characters = Character::when($search, function($query, $search) {
        return $query->where('name', 'like', "%{$search}%");
    })->get();

    return view('characters.index', compact('characters'));
}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $types = Type::all(); 
    $items = Item::all();
    return view("characters.create", compact('types','items')); 
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'strength' => 'required|integer',
            'defence' => 'required|integer',
            'speed' => 'required|integer',
            'intelligence' => 'required|integer',
            'life' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'items' => 'array', 
            'items.*.id' => 'required|exists:items,id', 
            'items.*.quantity' => 'required|integer|min:1', 
        ]);
    
        
        $character = Character::create($request->only(['name', 'description', 'strength', 'defence', 'speed', 'intelligence', 'life', 'type_id']));
    
        
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                $character->items()->attach($item['id'], ['quantity' => $item['quantity']]);
            }
        }
    
        return redirect()->route('characters.index')->with('success', 'Personaggio creato con successo!');
    }
    




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $character = Character::with('items')->findOrFail($id);

        $items = Item::all();

        return view('characters.show', compact('character', 'items'));
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
        $types = Type::all(); 
        $items = Item::all();
        

        return view('characters.edit', compact('character', 'types','items'));
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
    $character = Character::findOrFail($id);
    
    $character->name = $request->name;
    $character->description = $request->description;
    $character->strength = $request->strength;
    $character->defence = $request->defence;
    $character->speed = $request->speed;
    $character->intelligence = $request->intelligence;
    $character->life = $request->life;
    $character->type_id = $request->type_id;
    $character->save();

    $items = $request->input('items', []);
    
    $character->items()->detach();

    foreach ($items as $item) {
        $character->items()->attach($item['id'], ['quantity' => $item['quantity']]);
    }

    return redirect()->route('characters.index')->with('success', 'Personaggio aggiornato con successo!');
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