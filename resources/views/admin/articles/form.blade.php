@extends('layouts.admin')
@section('title', $article->exists ? 'Modifier : ' . Str::limit($article->title, 40) : 'Nouvel article')
    @section('breadcrumb')
        <a href="{{ route('admin.articles.index') }}" class="text-gray-400 hover:text-gray-600">Actualités</a>
        <span class="text-gray-300 mx-1">/</span>
        <span class="text-gray-700">{{ $article->exists ? Str::limit($article->title, 30) : 'Nouvel article' }}</span>
    @endsection

    @section('admin-content')
        <form action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf @if($article->exists) @method('PUT') @endif

            <div class="grid lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    {{-- Identification --}}
                    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Identification</h3>
                        <div class="space-y-4">
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div><label class="block text-sm font-medium text-gray-700 mb-1">Titre (FR) *</label>
                                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1">Title (EN)</label>
                                    <input type="text" name="title_en" value="{{ old('title_en', $article->title_en) }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1">Tag / Catégorie (FR)</label>
                                    <input type="text" name="tag" value="{{ old('tag', $article->tag) }}" placeholder="ex: Certifications" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1">Tag (EN)</label>
                                    <input type="text" name="tag_en" value="{{ old('tag_en', $article->tag_en) }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux"></div>
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div><label class="block text-sm font-medium text-gray-700 mb-1">Extrait (FR)</label>
                                    <textarea name="excerpt" rows="3" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux resize-y">{{ old('excerpt', $article->excerpt) }}</textarea></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1">Excerpt (EN)</label>
                                    <textarea name="excerpt_en" rows="3" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux resize-y">{{ old('excerpt_en', $article->excerpt_en) }}</textarea></div>
                            </div>
                        </div>
                    </div>

                    {{-- Contenu --}}
                    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6" x-data="{ langTab: 'fr' }">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Contenu</h3>
                            <div class="flex rounded-sm border border-gray-200 overflow-hidden">
                                <button type="button" @click="langTab='fr'" :class="langTab==='fr' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50'" class="px-3 py-1 text-xs font-semibold transition">FR</button>
                                <button type="button" @click="langTab='en'" :class="langTab==='en' ? 'bg-chocolate text-white' : 'text-gray-500 hover:bg-gray-50'" class="px-3 py-1 text-xs font-semibold transition">EN</button>
                            </div>
                        </div>
                        <div x-show="langTab === 'fr'"><x-admin.tiptap name="content" :value="old('content', $article->content)" :rows="14" /></div>
                        <div x-show="langTab === 'en'" style="display:none"><x-admin.tiptap name="content_en" :value="old('content_en', $article->content_en)" :rows="14" /></div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Publication</h3>
                        <div class="space-y-3 mb-4">
                            <div><label class="block text-xs font-medium text-gray-600 mb-1">Date de publication</label>
                                <input type="date" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-bordeaux"></div>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" value="1" {{ old('published', $article->published) ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300 text-bordeaux focus:ring-bordeaux">
                                <span class="text-sm text-gray-700">Publié (visible sur le site)</span></label>
                        </div>
                        <button type="submit" class="btn-primary w-full text-sm">Enregistrer</button>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-5">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Image principale</h3>
                        @if($article->image)<img src="{{ asset('storage/' . $article->image) }}" class="w-full rounded-sm mb-3 object-cover aspect-video">@endif
                        <input type="file" name="image" accept="image/*" class="text-xs text-gray-600 w-full">
                    </div>
                </div>
            </div>
        </form>

        {{-- Galerie photos (Hors du formulaire principal) --}}
        @if($article->exists)
        <div class="mt-8 bg-white border border-gray-200 rounded-sm shadow-sm p-6">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Galerie photos</h3>
            @php $gallery = $gallery ?? collect(); @endphp
            @if($gallery->count())
            <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-3 mb-4">
                @foreach($gallery as $photo)
                <div class="relative group aspect-square bg-gray-100 rounded-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover">
                    <form action="{{ route('admin.articles.gallery.delete', [$article, $photo]) }}" method="POST" class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm" onclick="return confirm('Supprimer ?')">✕</button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
            <form action="{{ route('admin.articles.gallery.upload', $article) }}" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-gray-300 rounded-sm p-6 text-center">
                @csrf
                <p class="text-sm text-gray-500 mb-3">Sélectionnez une ou plusieurs photos</p>
                <input type="file" name="photos[]" multiple accept="image/*" class="text-xs text-gray-500 mb-4 block mx-auto">
                <button type="submit" class="btn-primary py-2 px-6">Uploader les photos</button>
            </form>
        </div>
        @endif
    @endsection