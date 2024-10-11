<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Item;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $characters = Character::latest()->take(3)->get();
        $items = Item::latest()->take(3)->get();

        return view('home', compact('characters', 'items'));
    }
}