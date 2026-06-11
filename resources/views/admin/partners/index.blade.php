@extends('layouts.admin')
@section('title', 'Partenaires')
@section('topbar-action')
<a href="{{ route('admin.partners.create') }}" class="btn-primary text-xs py-2 px-4">+ Ajouter</a>
@endsection
@section('admin-content')
<div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200"><tr>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Partenaire</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Logo</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ordre</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actif</th>
            <th class="px-6 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($partners as $partner)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $partner->name }}</td>
                <td class="px-6 py-4 text-center">
                    @if($partner->logo)
                    <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" class="h-8 mx-auto object-contain">
                    @else<span class="text-gray-300 text-xs">—</span>@endif
                </td>
                <td class="px-6 py-4 text-center text-gray-500">{{ $partner->order }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="text-xs {{ $partner->active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }} px-2 py-0.5 rounded-sm">{{ $partner->active ? 'Oui' : 'Non' }}</span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.partners.edit', $partner) }}" class="text-xs text-industrial hover:underline mr-3">Modifier</a>
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Aucun partenaire.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
