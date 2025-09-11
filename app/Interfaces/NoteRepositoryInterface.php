<?php

namespace App\Repositories;

interface NoteRepositoryInterface
{
    /**
     * Retourne toutes les notes.
     */
    public function getAll();

    /**
     * Retourne une note par son identifiant.
     */
    public function findById($id);
}
