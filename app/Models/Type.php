<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Type extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $fillable = ['name', 'image', 'description'];
    protected $dates = ['deleted_at'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}