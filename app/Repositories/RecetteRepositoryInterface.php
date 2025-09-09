<?php

namespace App\Repositories;

interface RecetteRepositoryInterface
{
    /**
     * Retourne une recette aléatoire.
     */
    public function getRandomRecette();

    /**
     * Retourne une recette par son identifiant.
     */
    public function findById($id);

    /**
     * Retourne toutes les recettes.
     */
    public function getAll();
}