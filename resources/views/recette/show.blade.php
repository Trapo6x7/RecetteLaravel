@extends('layouts.app')

@section('content')
    <nav class="flex items-center justify-center px-8 py-4 shadow mb-8 rounded-lg">
        <a href="{{ route('recettes.random') }}" class="px-4 py-2 text-white">&#8635;</a>
    </nav>
    <div class="flex justify-center items-center min-h-[60vh]">
        <div class="w-full max-w-xl bg-white shadow-lg p-12 border border-gray-200" style="border-radius: 2rem;">
            <h1 class="text-xl font-bold py-6 text-[#111827] text-center">{{ $recette->name }}</h1>
            <div class="mb-10 flex flex-col md:flex-row md:justify-between gap-6">
                <div class="flex-1 p-6 bg-gray-50 border border-gray-200" style="border-radius: 1.5rem;">
                    <ul class="space-y-4 text-gray-700 text-center">
                        <li><span class="font-semibold"> Temps de préparation :</span> {{ $recette->preparation_time }} min
                        </li>
                        <li><span class="font-semibold"> Temps de cuisson :</span> {{ $recette->cooking_time }} min</li>
                        <li><span class="font-semibold"> Nombre de personnes :</span> {{ $recette->serves }}</li>
                    </ul>

                </div>
            </div>
            <h3 class="text-lg font-semibold py-3 text-[#111827] text-center">Ingrédients</h3>
            <ul class="grid grid-cols-2 gap-4 mb-2">
                @foreach ($recette->ingredients as $ingredient)
                    <li class="bg-gray-100 px-4 py-3 text-gray-800 border border-gray-200 text-center shadow-sm"
                        style="border-radius: 1rem;">{{ $ingredient->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="flex flex-col items-center gap-4">
        <button onclick="document.getElementById('modalAvis').classList.remove('hidden')"
            class="px-3 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition">Donner votre
            avis</button>

        <form method="POST" action="{{ route('recettes.reviewed', $recette->id) }}">
            @csrf
            <button type="submit"
                class="px-6 py-2 text-white rounded-xl shadow">
                J'ai déjà réalisé cette recette
            </button>
        </form>

        @if ($recette->reviewedRecettes->count() > 0)
            <span class="inline-block mt-2 px-2 py-2 bg-green-100 text-white rounded-full shadow">
                Cette recette a déjà été réalisée {{ $recette->reviewedRecettes->count() }} fois
            </span>
        @endif
    </div>

    <!-- Modale pour le formulaire d'avis -->
    <div id="modalAvis" class="fixed inset-0 flex items-center justify-center z-50 hidden"
        style="backdrop-filter: blur(6px); background: rgba(0,0,0,0.35);">
        <div class="bg-white rounded-2xl shadow-lg py-6 border border-gray-200 w-full max-w-xl relative"
            style="border-radius: 2rem;">
            <button onclick="document.getElementById('modalAvis').classList.add('hidden')"
                class="absolute top-4 right-4 text-gray-500 hover:text-indigo-600 text-3xl font-bold flex items-center justify-center w-10 h-10"
                aria-label="Fermer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form method="POST" action="{{ route('recettes.rate', $recette->id) }}">
                @csrf
                <h3 class="text-lg font-semibold mb-4 text-[#111827] text-center">Donner votre avis</h3>
                <div class="mb-4 flex flex-col items-center">
                    <label for="note" class="block mb-2 font-medium text-[#111827]">Note :</label>
                    <select name="note" id="note" class="rounded border-gray-300 px-4 py-2">
                        <option value="">Choisir une note</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} / 5</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="comment" class="block mb-2 font-medium text-[#111827] text-center">Commentaire :</label>
                    <textarea name="comment" id="comment" rows="3" class="w-full rounded border-gray-300 px-4 py-2"
                        placeholder="Votre avis..."></textarea>
                </div>
                <div class="flex justify-center py-3">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-[#111827] rounded-xl shadow hover:bg-indigo-700 transition">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Affichage des notes et commentaires --}}
    <div class="flex justify-center items-center mt-8">
        <div class="w-full max-w-xl bg-white rounded-2xl shadow p-8 border border-gray-200" style="border-radius: 2rem;">
            <h3 class="text-lg font-semibold py-6 text-[#111827] text-center">Avis des utilisateurs</h3>
            @forelse ($recette->notes as $note)
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                    <div class="flex items-center mb-2">
                        <span class="font-bold text-[#111827]">Note :</span>
                        <span class="ml-2 text-gray-800">{{ $note->note }} / 5</span>
                    </div>
                    @if ($note->comment)
                        <div class="text-[#111827] italic">"{{ $note->comment }}"</div>
                    @endif
                </div>
            @empty
                <div class="text-gray-500 text-center py-6">Aucun avis pour cette recette.</div>
            @endforelse
        </div>
    </div>
@endsection
