@extends('layouts.admin')
@section('title', $certification->exists ? 'Modifier la certification' : 'Nouvelle certification')
@section('admin-content')
<div class="max-w-2xl">
    <a href="{{ route('admin.certifications.index') }}" class="text-sm text-gray-500 hover:text-gray-900 mb-6 inline-flex items-center gap-1">← Retour</a>
    <form action="{{ $certification->exists ? route('admin.certifications.update', $certification) : route('admin.certifications.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
        @csrf @if($certification->exists) @method('PUT') @endif
        <div class="bg-white border border-gray-200 rounded-sm p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Nom (FR) *</label>
                    <input type="text" name="name" value="{{ old('name', $certification->name) }}" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Name (EN)</label>
                    <input type="text" name="name_en" value="{{ old('name_en', $certification->name_en) }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Description (FR)</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux resize-y">{{ old('description', $certification->description) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Description (EN)</label>
                <textarea name="description_en" rows="3" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux resize-y">{{ old('description_en', $certification->description_en) }}</textarea></div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    @if($certification->logo)<img src="{{ asset('storage/'.$certification->logo) }}" class="h-16 mb-2 object-contain">@endif
                    <input type="file" name="logo" accept="image/*" class="text-sm text-gray-600"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">PDF</label>
                    @if($certification->pdf)<a href="{{ asset('storage/'.$certification->pdf) }}" class="text-xs text-industrial hover:underline block mb-2" target="_blank">PDF actuel</a>@endif
                    <input type="file" name="pdf" accept=".pdf" class="text-sm text-gray-600"></div>
            </div>
            <div class="flex items-center gap-5">
                <div class="flex-1"><label class="block text-sm font-medium text-gray-700 mb-1">Ordre</label>
                    <input type="number" name="order" value="{{ old('order', $certification->order ?? 0) }}" min="0" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-bordeaux"></div>
                <div class="flex items-end pb-1"><label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" value="1" {{ old('active', $certification->active ?? true) ? 'checked' : '' }} class="rounded text-bordeaux">Actif</label></div>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('admin.certifications.index') }}" class="btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
