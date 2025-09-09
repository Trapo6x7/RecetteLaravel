<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository implements NoteRepositoryInterface
{
    public function getAll()
    {
        return Note::all();
    }

    public function findById($id)
    {
        return Note::find($id);
    }
}
