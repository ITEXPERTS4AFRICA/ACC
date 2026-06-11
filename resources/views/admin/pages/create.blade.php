@extends('layouts.admin')
@section('title', 'Nouvelle page')
@section('admin-content')
<div class="max-w-lg">
    <form action="{{ route('admin.pages.store') }}" method="POST" class="bg-white border border-gray-200 rounded-sm shadow-sm p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Clé unique *</label>
            <input type="text" name="key" required placeholder="ex: faq, careers..."
                   class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            <p class="text-xs text-gray-400 mt-1">Identifiant unique de la page (sans espaces ni caractères spéciaux)</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Titre *</label>
            <input type="text" name="title" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Créer la page</button>
            <a href="{{ route('admin.pages.index') }}" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
