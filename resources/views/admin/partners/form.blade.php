@extends('layouts.admin')
@section('title', $partner->exists ? 'Modifier partenaire' : 'Nouveau partenaire')
@section('admin-content')
<div class="max-w-lg">
    <a href="{{ route('admin.partners.index') }}" class="text-sm text-gray-400 hover:text-gray-600 mb-5 inline-flex items-center gap-1">← Retour</a>
    <form action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}"
          method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-sm shadow-sm p-6 space-y-4 mt-4">
        @csrf @if($partner->exists) @method('PUT') @endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
            <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Site web</label>
            <input type="url" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
            @if($partner->logo)<img src="{{ asset('storage/'.$partner->logo) }}" class="h-12 mb-2 object-contain">@endif
            <input type="file" name="logo" accept="image/*" class="text-sm text-gray-600">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ordre</label>
                <input type="number" name="order" value="{{ old('order', $partner->order ?? 0) }}" min="0" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" value="1" {{ old('active', $partner->active ?? true) ? 'checked' : '' }} class="w-4 h-4 rounded text-bordeaux">
                    <span class="text-sm text-gray-700">Actif</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('admin.partners.index') }}" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
