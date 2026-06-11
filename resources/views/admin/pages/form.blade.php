@extends('layouts.admin')
@section('title', 'Modifier : '.$page->title)
@section('breadcrumb')
<a href="{{ route('admin.pages.index') }}" class="text-gray-400 hover:text-gray-600">Pages</a>
<span class="text-gray-300 mx-1">/</span>
<span class="text-gray-700">{{ $page->title }}</span>
@endsection

@section('admin-content')
<form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Colonne principale --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Titres --}}
            <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 pb-3 border-b border-gray-100">Informations</h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Titre (FR) *</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                               class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title (EN)</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}"
                               class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux">
                    </div>
                </div>
            </div>

            {{-- Contenu WYSIWYG avec onglets FR/EN --}}
            <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6" x-data="{ langTab: 'fr' }">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Contenu</h3>
                    <div class="flex rounded-sm border border-gray-200 overflow-hidden">
                        <button type="button" @click="langTab='fr'"
                                :class="langTab==='fr' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50'"
                                class="px-3 py-1 text-xs font-semibold transition">FR</button>
                        <button type="button" @click="langTab='en'"
                                :class="langTab==='en' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50'"
                                class="px-3 py-1 text-xs font-semibold transition">EN</button>
                    </div>
                </div>
                <div x-show="langTab === 'fr'">
                    <x-admin.tiptap name="content" :value="old('content', $page->content)" :rows="12" label="Contenu (FR)"/>
                </div>
                <div x-show="langTab === 'en'" style="display:none">
                    <x-admin.tiptap name="content_en" :value="old('content_en', $page->content_en)" :rows="12" label="Content (EN)"/>
                </div>
            </div>

            {{-- SEO --}}
            <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 pb-3 border-b border-gray-100">SEO</h3>
                <div class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Meta Title (FR)</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" maxlength="200"
                                   class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Meta Title (EN)</label>
                            <input type="text" name="meta_title_en" value="{{ old('meta_title_en', $page->meta_title_en) }}" maxlength="200"
                                   class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Meta Description (FR)</label>
                            <textarea name="meta_description" rows="2" maxlength="500"
                                      class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux resize-none">{{ old('meta_description', $page->meta_description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Meta Description (EN)</label>
                            <textarea name="meta_description_en" rows="2" maxlength="500"
                                      class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux focus:border-bordeaux resize-none">{{ old('meta_description_en', $page->meta_description_en) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Colonne latérale --}}
        <div class="space-y-6">
            {{-- Actions --}}
            <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Publication</h3>
                <div class="flex gap-2 mb-4">
                    <button type="submit" name="status" value="published" class="btn-primary flex-1 text-center text-xs py-2">
                        Publier
                    </button>
                    <button type="submit" name="status" value="draft" class="btn-secondary flex-1 text-center text-xs py-2">
                        Brouillon
                    </button>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <span class="w-2 h-2 rounded-full {{ $page->status === 'published' ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                    Statut actuel : <strong>{{ $page->status === 'published' ? 'Publié' : 'Brouillon' }}</strong>
                </div>
            </div>

            {{-- Image hero --}}
            <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Image hero</h3>
                @if($page->hero_image)
                <img src="{{ asset('storage/'.$page->hero_image) }}" class="w-full rounded-sm mb-3 object-cover aspect-video">
                @endif
                <input type="file" name="hero_image" accept="image/*" class="text-xs text-gray-600 w-full">
            </div>

            {{-- Infos page --}}
            <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Informations</h3>
                <dl class="space-y-2 text-xs">
                    <div class="flex justify-between"><dt class="text-gray-400">Clé</dt><dd><code class="bg-gray-100 px-1 rounded">{{ $page->key }}</code></dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Créée</dt><dd class="text-gray-600">{{ $page->created_at->format('d/m/Y') }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Modifiée</dt><dd class="text-gray-600">{{ $page->updated_at->format('d/m/Y H:i') }}</dd></div>
                </dl>
            </div>
        </div>
    </div>
</form>
@endsection
