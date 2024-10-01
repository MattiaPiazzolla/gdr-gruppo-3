<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $characters = config("characters");

        foreach ($characters as $character) {
            
            $new_character = new Character();

        $new_character->name = $character['name'];
        $new_character->description = $character['description'];
        $new_character->strength = $character['strength'];
        $new_character->defence = $character['defence'];
        $new_character->speed = $character['speed'];
        $new_character->intelligence = $character['intelligence'];
        $new_character->life = $character['life'];
        $new_character->type_id = $character['type_id'];

        $new_character->save();
        }
    }
}