<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ingredient extends Model
{
   protected $fillable = [
        'name',
    ];

    public function recettes()
    {
     // Relation ManyToMany avec Recette via la table recette_ingredient
    return $this->belongsToMany(Recette::class, 'recette_ingredient');
    }
}
