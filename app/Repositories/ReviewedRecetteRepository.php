<?php

namespace App\Repositories;

use App\Models\ReviewedRecette;

class ReviewedRecetteRepository implements ReviewedRecetteRepositoryInterface
{
    public function getAll()
    {
        return ReviewedRecette::all();
    }

    public function findById($id)
    {
        return ReviewedRecette::find($id);
    }
}
