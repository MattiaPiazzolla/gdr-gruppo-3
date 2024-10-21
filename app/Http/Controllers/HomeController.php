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
        // Recupera gli ultimi 3 personaggi, oggetti e tipi
        $latestCharacters = Character::orderBy('created_at', 'desc')->take(3)->get();
        $latestItems = Item::orderBy('created_at', 'desc')->take(3)->get();
        $latestTypes = Type::orderBy('created_at', 'desc')->take(3)->get();

        return view('home', compact('latestCharacters', 'latestItems', 'latestTypes')); 
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