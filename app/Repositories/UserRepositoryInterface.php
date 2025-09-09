<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Retourne tous les utilisateurs.
     */
    public function getAll();

    /**
     * Retourne un utilisateur par son identifiant.
     */
    public function findById($id);
}
