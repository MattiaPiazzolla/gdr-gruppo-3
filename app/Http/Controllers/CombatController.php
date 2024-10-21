<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CombatController extends Controller
{
    public function startCombat($character1Id, $character2Id)
    {
        // Trova i personaggi e le loro armi
        $character1 = Character::with('item')->find($character1Id);
        $character2 = Character::with('item')->find($character2Id);

        // Controlla se i personaggi esistono
        if (!$character1 || !$character2) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        // Avvia il combattimento
        $winner = $this->performCombat($character1, $character2);

        return response()->json([
            'winner' => $winner->name,
            'loser' => ($winner->id == $character1->id) ? $character2->name : $character1->name
        ]);
    }

    public function performCombat($character1, $character2)
    {
        while ($character1->life > 0 && $character2->life > 0) {
            // Attacco del personaggio 1 su personaggio 2
            $damageToCharacter2 = $character1->attack($character2);
            $character2->life -= $damageToCharacter2;

            // Attacco del personaggio 2 su personaggio 1
            $damageToCharacter1 = $character2->attack($character1);
            $character1->life -= $damageToCharacter1;
        }

        // Determina il vincitore
        return ($character1->life > 0) ? $character1 : $character2;
    }
}


