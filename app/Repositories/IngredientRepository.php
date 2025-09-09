<?php

namespace App\Repositories;

use App\Models\Ingredient;

class IngredientRepository implements IngredientRepositoryInterface
{
    public function getAll()
    {
        return Ingredient::all();
    }

    public function findById($id)
    {
        return Ingredient::find($id);
    }
}
