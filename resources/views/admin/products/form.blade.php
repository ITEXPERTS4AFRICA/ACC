@extends('layouts.admin')
@section('title', $product->exists ? 'Modifier : '.$product->name : 'Nouveau produit')
@section('breadcrumb')
<a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600">Produits</a>
<span class="text-gray-300 mx-1">/</span>
<span class="text-gray-700">{{ $product->exists ? $product->name : 'Nouveau' }}</span>
@endsection

@section('admin-content')
<div class="space-y-6">
    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf @if($product->exists) @method('PUT') @endif

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Colonne principale --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Noms --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Identification</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom (FR) *</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                   class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name (EN)</label>
                            <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}"
                                   class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux">
                        </div>
                    </div>
                </div>

                {{-- Descriptions courtes --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Description courte</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">FR</label>
                            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux resize-y">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">EN</label>
                            <textarea name="description_en" rows="4" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux resize-y">{{ old('description_en', $product->description_en) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Description complète WYSIWYG --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6" x-data="{ langTab: 'fr' }">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Description complète</h3>
                        <div class="flex rounded-sm border border-gray-200 overflow-hidden">
                            <button type="button" @click="langTab='fr'" :class="langTab==='fr' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50'" class="px-3 py-1 text-xs font-semibold transition">FR</button>
                            <button type="button" @click="langTab='en'" :class="langTab==='en' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50'" class="px-3 py-1 text-xs font-semibold transition">EN</button>
                        </div>
                    </div>
                    <div x-show="langTab === 'fr'">
                        <x-admin.tiptap name="description_full" :value="old('description_full', $product->description_full)" :rows="10"/>
                    </div>
                    <div x-show="langTab === 'en'" style="display:none">
                        <x-admin.tiptap name="description_full_en" :value="old('description_full_en', $product->description_full_en)" :rows="10"/>
                    </div>
                </div>
            </div>

            {{-- Colonne latérale --}}
            <div class="space-y-6">
                {{-- Sauvegarder --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Actions</h3>
                    <button type="submit" class="btn-primary w-full text-center text-sm">Enregistrer</button>
                    <a href="{{ route('admin.products.index') }}" class="block text-center text-xs text-gray-400 hover:text-gray-600 mt-3">Annuler</a>
                </div>

                {{-- Actif / Ordre --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5 space-y-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Options</h3>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Ordre d'affichage</label>
                        <input type="number" name="order" value="{{ old('order', $product->order ?? 0) }}" min="0"
                               class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux">
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" value="1" {{ old('active', $product->active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-gray-300 text-bordeaux focus:ring-bordeaux">
                        <span class="text-sm text-gray-700">Produit actif (visible sur le site)</span>
                    </label>
                </div>

                {{-- Image --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Image principale</h3>
                    @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full rounded-sm mb-3 object-cover aspect-square">
                    @endif
                    <input type="file" name="image" accept="image/*" class="text-xs text-gray-600 w-full">
                </div>

                {{-- PDF --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Fiche PDF</h3>
                    @if($product->pdf_datasheet)
                    <a href="{{ asset('storage/'.$product->pdf_datasheet) }}" target="_blank"
                       class="flex items-center gap-2 text-xs text-industrial hover:underline mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                        PDF actuel
                    </a>
                    @endif
                    <input type="file" name="pdf_datasheet" accept=".pdf" class="text-xs text-gray-600 w-full">
                </div>
            </div>
        </div>
    </form>

    {{-- Variantes (si produit existant) - DÉPLACÉ HORS DU FORM PRINCIPAL --}}
    @if($product->exists)
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6 lg:max-w-2xl">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Variantes produit</h3>

        @if($product->variants)
        <div class="space-y-2 mb-4">
            @foreach($product->variants as $idx => $variant)
            <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-sm px-4 py-2">
                <div class="flex items-center gap-3">
                    <span class="font-medium text-sm text-gray-900">{{ $variant['name'] ?? '' }}</span>
                    @if(isset($variant['code']))
                    <code class="text-xs bg-industrial/10 text-industrial px-2 py-0.5 rounded">{{ $variant['code'] }}</code>
                    @endif
                    @if(isset($variant['badge']))
                    <span class="text-xs bg-industrial text-white px-2 py-0.5 rounded-sm">{{ $variant['badge'] }}</span>
                    @endif
                </div>
                <form action="{{ route('admin.products.variants.destroy', [$product, $idx]) }}" method="POST"
                      onsubmit="return confirm('Supprimer cette variante ?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 hover:underline">✕</button>
                </form>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Ajouter variante --}}
        <form action="{{ route('admin.products.variants.store', $product) }}" method="POST"
              class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-surface/50 border border-dashed border-gray-300 rounded-sm p-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nom *</label>
                <input type="text" name="name" placeholder="Natural" required class="w-full border border-gray-300 rounded-sm px-2 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Code</label>
                <input type="text" name="code" placeholder="ML-NAT" class="w-full border border-gray-300 rounded-sm px-2 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Badge</label>
                <input type="text" name="badge" placeholder="Renouvellement annuel" class="w-full border border-gray-300 rounded-sm px-2 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-bordeaux">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full btn-primary text-xs py-1.5">Ajouter</button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection
