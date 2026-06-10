@extends('layouts.admin')
@section('title', $user->exists ? 'Modifier : '.$user->name : 'Nouvel utilisateur')
@section('breadcrumb')
<a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600">Utilisateurs</a>
<span class="text-gray-300 mx-1">/</span>
<span class="text-gray-700">{{ $user->exists ? $user->name : 'Nouveau' }}</span>
@endsection

@section('admin-content')
<div class="max-w-lg">
    <form action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
          method="POST" class="space-y-5">
        @csrf @if($user->exists) @method('PUT') @endif

        <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe {{ $user->exists ? '(laisser vide pour ne pas changer)' : '*' }}</label>
                <input type="password" name="password" {{ $user->exists ? '' : 'required' }} autocomplete="new-password"
                       class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rôle *</label>
                <select name="role" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                    <option value="editor" {{ old('role', $user->role ?? 'editor') === 'editor' ? 'selected' : '' }}>Éditeur (accès contenu)</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur (accès total)</option>
                </select>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="active" value="0">
                <input type="checkbox" name="active" value="1" {{ old('active', $user->active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-bordeaux focus:ring-bordeaux">
                <span class="text-sm text-gray-700">Compte actif</span>
            </label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
