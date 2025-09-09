<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportRecettes extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'recettes:import';
    protected $description = 'Importe les recettes depuis le fichier JSON';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $json = file_get_contents(storage_path('app/recipes.json'));
        $data = json_decode($json, true);

        if (!isset($data['recipes'])) {
            $this->error('Le fichier JSON ne contient pas de clé "recipes".');
            return;
        }

        foreach ($data['recipes'] as $recetteData) {
            // Vérifie si la recette existe déjà
            $recette = \App\Models\Recette::where('name', $recetteData['name'])->first();
            if (!$recette) {
                // Crée la recette
                $recette = \App\Models\Recette::create([
                    'name' => $recetteData['name'],
                    'preparation_time' => preg_replace('/[^0-9]/', '', $recetteData['preparationTime']),
                    'cooking_time' => preg_replace('/[^0-9]/', '', $recetteData['cookingTime']),
                    'serves' => $recetteData['serves'],
                ]);
            }

            $ingredientIds = [];
            foreach ($recetteData['ingredients'] as $ingredientName) {
                // Vérifie si l'ingrédient existe déjà
                $ingredient = \App\Models\Ingredient::where('name', $ingredientName)->first();
                if (!$ingredient) {
                    $ingredient = \App\Models\Ingredient::create(['name' => $ingredientName]);
                }
                $ingredientIds[] = $ingredient->id;
            }
            // Associe les ingrédients à la recette sans doublons
            $recette->ingredients()->syncWithoutDetaching($ingredientIds);
        }

        $this->info('Import des recettes terminé !');
    }
}
