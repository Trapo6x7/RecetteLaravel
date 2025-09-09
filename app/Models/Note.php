<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    protected $fillable = [
        'note',
        'comment',
        'recette_id',
    ];

    public function recette()
    {
        // Une note appartient à une recette
        return $this->belongsTo(Recette::class);
    }
}
