@extends('layouts.admin')
@section('title', 'Médiathèque')
@section('breadcrumb')<span class="text-gray-700">Médiathèque</span>@endsection

@section('admin-content')
<div class="space-y-6">
    {{-- Upload zone --}}
    <div class="bg-white border border-gray-200 rounded-sm shadow-sm p-6"
         x-data="mediaUploader()" @dragover.prevent="dragging=true" @dragleave="dragging=false" @drop.prevent="handleDrop($event)">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Uploader des fichiers</h3>
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" x-ref="uploadForm">
            @csrf
            <div :class="dragging ? 'border-bordeaux bg-bordeaux/5' : 'border-gray-300'"
                 class="border-2 border-dashed rounded-sm p-10 text-center transition-colors cursor-pointer"
                 @click="$refs.fileInput.click()">
                <div class="text-4xl mb-3">📁</div>
                <p class="text-sm text-gray-600 font-medium">Glissez vos fichiers ici ou <span class="text-bordeaux underline">cliquez pour choisir</span></p>
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP, GIF, PDF — max 20 MB par fichier</p>
                <input type="file" name="files[]" multiple accept="image/*,.pdf" x-ref="fileInput" class="hidden"
                       @change="submitForm">
            </div>
        </form>
        <div x-show="uploading" class="mt-3 text-center text-sm text-gray-500">
            <span class="animate-pulse">Upload en cours...</span>
        </div>
    </div>

    {{-- Filtres --}}
    <div class="flex items-center justify-between">
        <div class="flex gap-2">
            @foreach(['all' => 'Tous', 'image' => 'Images', 'pdf' => 'PDFs'] as $t => $label)
            <a href="{{ route('admin.media.index', ['type' => $t]) }}"
               class="px-3 py-1.5 text-xs font-medium rounded-sm border transition
                      {{ $type === $t ? 'bg-chocolate text-white border-chocolate' : 'border-gray-300 text-gray-600 hover:border-gray-400' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
        <p class="text-xs text-gray-400">{{ $files->total() }} fichier(s)</p>
    </div>

    {{-- Grille --}}
    @if($files->count())
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
        @foreach($files as $file)
        <div class="group relative bg-white border border-gray-200 rounded-sm overflow-hidden hover:shadow-md transition"
             x-data="{ copied: false }">
            {{-- Aperçu --}}
            <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                @if($file->type === 'image')
                <img src="{{ $file->public_url }}" alt="{{ $file->alt ?? $file->name }}"
                     class="w-full h-full object-cover" loading="lazy">
                @else
                <div class="flex flex-col items-center gap-1 p-3 text-center">
                    <span class="text-3xl">📄</span>
                    <span class="text-[10px] text-gray-500 break-all">{{ Str::limit($file->name, 20) }}</span>
                </div>
                @endif
            </div>

            {{-- Overlay actions --}}
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2 p-2">
                <button type="button"
                        @click="navigator.clipboard.writeText('{{ $file->public_url }}').then(() => { copied=true; setTimeout(() => copied=false, 2000) })"
                        class="w-full text-center text-[10px] font-semibold bg-white text-chocolate px-2 py-1 rounded-sm hover:bg-cream transition">
                    <span x-show="!copied">Copier l'URL</span>
                    <span x-show="copied" class="text-green-700">✓ Copié !</span>
                </button>
                <form action="{{ route('admin.media.destroy', $file) }}" method="POST"
                      onsubmit="return confirm('Supprimer ce fichier ?')" class="w-full">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full text-[10px] font-semibold bg-red-600 text-white px-2 py-1 rounded-sm hover:bg-red-700 transition">
                        Supprimer
                    </button>
                </form>
            </div>

            {{-- Info bas --}}
            <div class="px-2 py-1.5 border-t border-gray-100">
                <p class="text-[10px] text-gray-500 truncate" title="{{ $file->name }}">{{ Str::limit($file->name, 22) }}</p>
                <p class="text-[10px] text-gray-400">{{ $file->formatted_size }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $files->links() }}</div>
    @else
    <div class="bg-white border border-gray-200 rounded-sm py-20 text-center">
        <div class="text-5xl mb-4">📂</div>
        <p class="text-gray-400">Aucun fichier dans la médiathèque.</p>
    </div>
    @endif
</div>

@push('scripts')
<script>
function mediaUploader() {
    return {
        dragging: false,
        uploading: false,
        handleDrop(e) {
            this.dragging = false;
            const dt = e.dataTransfer;
            if (!dt.files.length) return;
            const input = this.$refs.fileInput;
            input.files = dt.files;
            this.submitForm();
        },
        submitForm() {
            this.uploading = true;
            this.$refs.uploadForm.submit();
        },
    };
}
</script>
@endpush
@endsection
