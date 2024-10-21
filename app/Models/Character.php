<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Character extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        "name",
        "description",
        "strength",
        "defence",
        "speed",
        "intelligence",
        "life",
        "type_id",
        'image'
    ];

    protected $dates = ['deleted_at']; 

    public function attack(Character $opponent)
    {
        // Danno dell'arma basato su `dice`
        $weaponDamage = $this->item ? rand(1, $this->item->dice) : 0;

        // Calcola il danno totale basato sulle statistiche del personaggio
        $damage = $this->strength + $weaponDamage - $opponent->defence;

        // Assicurati che il danno non sia negativo
        return max(0, $damage);
    }

    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}