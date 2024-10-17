<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'type' => 'required|string|max:255',
        'weight' => 'required|numeric',
        'cost' => 'required|numeric',
        'dice' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $item = new Item();
    $item->name = $request->name;
    $item->category = $request->category;
    $item->type = $request->type;
    $item->weight = $request->weight;
    $item->cost = $request->cost;
    $item->dice = $request->dice;
    $item->slug = Str::slug($request->name);

   
    if ($request->hasFile('image')) {
        $imageName = $item->slug . '.' . $request->image->extension();
        $request->image->move(public_path('img/Items_icons'), $imageName);
    } else {
       
        $imageName = 'placeholder';
    }



    $item->save();

    return redirect()->route('items.index')->with('success', 'Item creato con successo!');
}


    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'type' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'cost' => 'required|numeric',
            'dice' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
    
        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->category = $request->category;
        $item->type = $request->type;
        $item->weight = $request->weight;
        $item->cost = $request->cost;
        $item->dice = $request->dice;
        $item->slug = Str::slug($request->name);
    
        if ($request->hasFile('image')) {
            $imageName = $item->slug . '.' . $request->image->extension();
            $request->image->move(public_path('img/Items_icons'), $imageName);
        }
    
        $item->save();
    
        return redirect()->route('items.index')->with('success', 'Item aggiornato con successo!');
    }

public function destroy($id)
{
    $item = Item::findOrFail($id);

    $imagePath = public_path('img/Items_icons/' . $item->name . '.png');

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $item->delete();

    return redirect()->route('items.index')->with('success', 'Item eliminato con successo!');
}
}