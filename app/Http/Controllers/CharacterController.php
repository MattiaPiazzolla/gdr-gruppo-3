<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Item; 
use App\Models\Type;
use Illuminate\Support\Facades\Storage; 

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

        // Ottieni i personaggi attivi
        $characters = Character::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->whereNull('deleted_at')->get(); 

        // Ottieni i personaggi eliminati (soft deleted)
        $deletedCharacters = Character::onlyTrashed()->get(); 

        return view('characters.index', compact('characters', 'deletedCharacters'));
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
            'description' => 'required|string|max:500',
            'strength' => 'required|integer',
            'defence' => 'required|integer',
            'speed' => 'required|integer',
            'intelligence' => 'required|integer',
            'life' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        // Crea un nuovo personaggio
        $character = new Character();
        $character->name = $request->name;
        $character->description = $request->description;
        $character->strength = $request->strength;
        $character->defence = $request->defence;
        $character->speed = $request->speed;
        $character->intelligence = $request->intelligence;
        $character->life = $request->life;
        $character->type_id = $request->type_id;

        // Salva l'immagine se presente
        if ($request->hasFile('image')) {
            $imageName = $character->name . '.' . $request->image->extension();
            $request->image->move(public_path('img/character_images'), $imageName);
        }

        // Salva il personaggio
        $character->save();

        // Gestisci l'inventario
        $items = $request->input('items', []);
        foreach ($items as $item) {
            $character->items()->attach($item['id'], ['quantity' => $item['quantity']]);
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
        $character = Character::findOrFail($id);
        $types = Type::all();
        $items = Item::all();

        return view('characters.edit', compact('character', 'types', 'items'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'strength' => 'required|integer',
            'defence' => 'required|integer',
            'speed' => 'required|integer',
            'intelligence' => 'required|integer',
            'life' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        $character = Character::findOrFail($id);
        $character->name = $request->name;
        $character->description = $request->description;
        // ... altre proprietà
    
        // Salva l'immagine se presente
        if ($request->hasFile('image')) {
            $imageName = $character->name . '.' . $request->image->extension();
            $request->image->move(public_path('img/character_images'), $imageName);
        }
    
        // Salva il personaggio
        $character->save();
    
        // Gestisci l'inventario
        $items = $request->input('items', []);
        $character->items()->detach(); // Rimuovi tutti gli oggetti esistenti
        foreach ($items as $item) {
            $character->items()->attach($item['id'], ['quantity' => $item['quantity']]);
        }
    
        return redirect()->route('characters.index')->with('success', 'Personaggio aggiornato con successo!');
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
{
    $character = Character::findOrFail($id);
    $character->delete(); 

    return redirect()->route('characters.index')->with('success', 'Personaggio eliminato con successo.');
}
    public function softDelete($id)
    {
        $character = Character::findOrFail($id);
        
        // Soft delete
        $character->delete();

        return redirect()->route('characters.index')->with('success', 'Personaggio spostato nel cestino con successo!');
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $character = Character::withTrashed()->findOrFail($id);
        $character->restore();

        return redirect()->route('characters.index')->with('success', 'Personaggio ripristinato con successo!');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $character = Character::withTrashed()->findOrFail($id);

        // Rimuovi l'immagine associata, se necessario
        $imagePath = public_path('img/character_images/' . $character->name . '.webp'); 

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Elimina definitivamente il personaggio
        $character->forceDelete();

        return redirect()->route('characters.index')->with('success', 'Personaggio eliminato definitivamente con successo!');
    }
}