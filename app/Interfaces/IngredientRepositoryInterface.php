<?php

namespace App\Repositories;

interface IngredientRepositoryInterface
{
    /**
     * Retourne tous les ingrédients.
     */
    public function getAll();

    /**
     * Retourne un ingrédient par son identifiant.
     */
    public function findById($id);
}
