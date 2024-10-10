<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Item;

use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
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
        'category' => 'required|string|max:100',
        'type' => 'required|string|max:255',
        'weight' => 'required|numeric',
        'cost' => 'required|numeric',
        'dice' => 'required|string|max:255',
    ]);

    $item = new Item();
    $item->name = $request->name;
    $item->category = $request->category;
    $item->type = $request->type;
    $item->weight = $request->weight;
    $item->cost = $request->cost;
    $item->dice = $request->dice;
    $item->slug = Str::slug($request->name);

    $item->save();

    return redirect()->route('items.index')->with('success', 'Item creato con successo!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
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

            'type' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'cost' => 'required|numeric',
            'dice' => 'required|string|max:255',
        ]);
    
       
        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->type = $request->type;        
        $item->weight = $request->weight;    
        $item->cost = $request->cost;        
        $item->dice = $request->dice;        
        $item->slug = Str::slug($request->name);
        
        $item->save();
    
        return redirect()->route('items.index')->with('success', 'Item aggiornato con successo!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Oggetto eliminato con successo!');
    }
}