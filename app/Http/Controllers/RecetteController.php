<?php

namespace App\Http\Controllers;

use App\Repositories\RecetteRepositoryInterface;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    protected $recetteRepo;

    /**
     * Injecte le repository des recettes.
     */
    public function __construct(RecetteRepositoryInterface $recetteRepo)
    {
        $this->recetteRepo = $recetteRepo;
    }

    /**
     * Affiche une recette aléatoire.
     */
    public function showRandom()
    {
        $recette = $this->recetteRepo->getRandomRecette();
        return view('recette.show', compact('recette'));
    }

    /**
     * Affiche toutes les recettes.
     */
    public function index()
    {
        $recettes = $this->recetteRepo->getAll();
        return view('recette.index', compact('recettes'));
    }

    /**
     * Affiche une recette par son id.
     */
    public function show($id)
    {
        $recette = $this->recetteRepo->findById($id);
        return view('recette.show', compact('recette'));
    }
    /**
     * Enregistre la note et le commentaire pour une recette.
     */
    public function rate(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // On suppose que le modèle Note existe et a les bons champs
        \App\Models\Note::create([
            'recette_id' => $id,
            'note' => $request->input('note'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('recettes.show', $id)
            ->with('success', 'Merci pour votre avis !');
    }
    /**
     * Enregistre qu'une recette a été réalisée (anonyme).
     */
    public function reviewed(Request $request, $id)
    {
        \App\Models\ReviewedRecette::create([
            'recette_id' => $id,
            'user_id' => null, // anonyme
            'reviewed' => true,
        ]);
        return redirect()->route('recettes.show', $id)
            ->with('success', 'Recette signalée comme réalisée !');
    }
}
