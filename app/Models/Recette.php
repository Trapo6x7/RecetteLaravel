<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class recette extends Model
{
    protected $fillable = [
        'name',
        'preparation_time',
        'cooking_time',
        'serves'
    ];

    public function notes()
    {
        // Une recette a plusieurs notes
        return $this->hasMany(Note::class);
    }

    public function ingredients()
    {
        // Relation ManyToMany avec Ingredient via la table recette_ingredient
        return $this->belongsToMany(Ingredient::class, 'recette_ingredient');
    }

    public function reviewedRecettes()
    {
        // Une recette a plusieurs avis
        return $this->hasMany(ReviewedRecette::class);
    }
}
