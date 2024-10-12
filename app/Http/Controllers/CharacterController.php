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
    
        if ($request->has('item_ids')) {
            foreach ($request->input('item_ids') as $itemId) {
                $quantity = $request->input("quantities.$itemId", 1); 
                $character->items()->attach($itemId, ['quantity' => $quantity]);
            }
        }
    
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


    if ($request->has('items')) {
        $syncData = [];
        foreach ($request->input('items') as $itemData) {
            if (isset($itemData['id'])) {
                $syncData[$itemData['id']] = ['quantity' => $itemData['quantity']];
            }
        }

        $character->items()->sync($syncData);
    } else {
        $character->items()->sync([]);
    }

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