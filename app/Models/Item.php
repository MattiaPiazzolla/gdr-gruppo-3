<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'type',
        'weight',
        'cost',
        'dice',
        'image'
    ];

   
    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_item')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}