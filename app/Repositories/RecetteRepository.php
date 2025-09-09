<?php

namespace App\Repositories;

use App\Models\Recette;

class RecetteRepository implements RecetteRepositoryInterface
{
    public function getRandomRecette()
    {
        return Recette::inRandomOrder()->first();
    }

    public function findById($id)
    {
        return Recette::find($id);
    }

    public function getAll()
    {
        return Recette::all();
    }
}
