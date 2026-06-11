@extends('layouts.admin')
@section('title', 'Actualités')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $articles->count() }} article(s)</p>
    <a href="{{ route('admin.articles.create') }}" class="btn-primary text-sm py-2 px-5">+ Ajouter</a>
</div>
<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200"><tr>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre</th>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tag</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Publié</th>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
            <th class="px-6 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($articles as $article)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900 max-w-xs truncate">{{ $article->title }}</td>
                <td class="px-6 py-4"><span class="text-xs bg-industrial/10 text-industrial px-2 py-0.5 rounded-sm">{{ $article->tag ?? '—' }}</span></td>
                <td class="px-6 py-4 text-center">{{ $article->published ? '✓' : '—' }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $article->published_at?->format('d/m/Y') ?? '—' }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-xs text-industrial hover:underline mr-3">Modifier</a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Aucun article.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
