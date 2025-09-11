<?php

namespace App\Repositories;

interface ReviewedRecetteRepositoryInterface
{
    /**
     * Retourne tous les avis de recette.
     */
    public function getAll();

    /**
     * Retourne un avis par son identifiant.
     */
    public function findById($id);
}
