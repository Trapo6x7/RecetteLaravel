<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewedRecette extends Model
{
    protected $fillable = [
        'user_id',
        'recette_id',
        'reviewed'
    ];

    public function user()
    {
        // Cette association appartient à un utilisateur
        return $this->belongsTo(User::class);
    }

    /**
     * Cette association appartient à une recette
     */
    public function recette()
    {
        return $this->belongsTo(Recette::class);
    }
}
