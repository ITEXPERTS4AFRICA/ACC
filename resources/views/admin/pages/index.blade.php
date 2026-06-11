@extends('layouts.admin')
@section('title', 'Pages')
@section('breadcrumb')<span class="text-gray-700">Pages</span>@endsection

@section('topbar-action')
<a href="{{ route('admin.pages.create') }}" class="btn-primary text-xs py-2 px-4">+ Nouvelle page</a>
@endsection

@section('admin-content')
<div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Clé</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Modifié</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pages as $page)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-900">{{ $page->title }}</p>
                    @if($page->title_en)<p class="text-gray-400 text-xs">EN: {{ $page->title_en }}</p>@endif
                </td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <code class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded">{{ $page->key }}</code>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2 py-1 rounded-sm
                        {{ $page->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $page->status === 'published' ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                        {{ $page->status === 'published' ? 'Publié' : 'Brouillon' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs hidden lg:table-cell">
                    {{ $page->updated_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="text-xs text-industrial hover:underline">Modifier</a>
                        @if($page->key !== 'home')
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Supprimer cette page ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:underline">Supprimer</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-16 text-center text-gray-400">Aucune page configurée.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
