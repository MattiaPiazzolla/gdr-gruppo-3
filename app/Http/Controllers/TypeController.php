<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $types = Type::when($search, function($query, $search) {
        return $query->where('name', 'like', "%{$search}%");
    })->whereNull('deleted_at')->get(); 

    $deletedTypes = Type::onlyTrashed()->get();

    return view('types.index', compact('types', 'deletedTypes'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
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
            'image' => 'required|string',
            'description' => 'required|string',
        ]);

        Type::create($request->all());
        return redirect()->route('types.index')->with('success', 'Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string',
            'description' => 'required|string',
        ]);

        $type->update($request->all());
        return redirect()->route('types.index')->with('success', 'Il tipo è stato aggiornato con successo.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id); 
        $type->delete(); 

        return redirect()->route('types.index')->with('success', 'Tipo eliminato con successo.');
    }

    public function softDelete($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Tipo spostato nel cestino con successo!');
    }

    public function restore($id)
    {
        $type = Type::withTrashed()->findOrFail($id);
        $type->restore();
        return redirect()->route('types.index')->with('success', 'Tipo ripristinato con successo!');
    }

    public function forceDelete($id)
    {
        $type = Type::withTrashed()->findOrFail($id);


        $type->forceDelete();
        return redirect()->route('types.index')->with('success', 'Tipo eliminato definitivamente!');
    }
}