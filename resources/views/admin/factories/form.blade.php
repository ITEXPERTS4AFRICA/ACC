@extends('layouts.admin')
@section('title', $factory->exists ? 'Modifier l\'usine' : 'Nouvelle usine')
@section('admin-content')
<div class="max-w-3xl">
    <a href="{{ route('admin.factories.index') }}" class="text-sm text-gray-500 hover:text-gray-900 mb-6 inline-flex items-center gap-1">← Retour</a>
    <form action="{{ $factory->exists ? route('admin.factories.update', $factory) : route('admin.factories.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
        @csrf @if($factory->exists) @method('PUT') @endif
        <div class="bg-white border border-gray-200 rounded-sm p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                    <input type="text" name="name" value="{{ old('name', $factory->name) }}" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Name (EN)</label>
                    <input type="text" name="name_en" value="{{ old('name_en', $factory->name_en) }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Ville *</label>
                    <input type="text" name="city" value="{{ old('city', $factory->city) }}" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Pays *</label>
                    <input type="text" name="country" value="{{ old('country', $factory->country) }}" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Capacité (MT)</label>
                    <input type="number" name="capacity_mt" value="{{ old('capacity_mt', $factory->capacity_mt) }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux">
                        @foreach(['operational'=>'En opération','construction'=>'En construction','planned'=>'Planifié'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $factory->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Description (FR)</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux resize-y">{{ old('description', $factory->description) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Description (EN)</label>
                <textarea name="description_en" rows="4" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux resize-y">{{ old('description_en', $factory->description_en) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                @if($factory->image)<img src="{{ asset('storage/'.$factory->image) }}" class="h-24 mb-2 object-cover rounded-sm">@endif
                <input type="file" name="image" accept="image/*" class="text-sm text-gray-600"></div>
            <div class="flex items-center gap-5">
                <div class="flex-1"><label class="block text-sm font-medium text-gray-700 mb-1">Ordre</label>
                    <input type="number" name="order" value="{{ old('order', $factory->order ?? 0) }}" min="0" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div class="flex items-end pb-1"><label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" value="1" {{ old('active', $factory->active ?? true) ? 'checked' : '' }} class="rounded text-bordeaux">Actif</label></div>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('admin.factories.index') }}" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
