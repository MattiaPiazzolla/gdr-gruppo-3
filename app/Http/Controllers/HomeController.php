<?php
namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $characters = Character::all();
        return view('home', compact('characters')); 
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $items = Item::where('name', 'LIKE', "%$query%")->get();
        $characters = Character::where('name', 'LIKE', "%$query%")->get();
        $types = Type::where('name', 'LIKE', "%$query%")->get();
    
        return view('search_results', compact('items', 'characters', 'types', 'query'));
    }
}