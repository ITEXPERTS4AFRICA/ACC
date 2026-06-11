@extends('layouts.admin')
@section('title', 'Usines')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $factories->count() }} usine(s)</p>
    <a href="{{ route('admin.factories.create') }}" class="btn-primary text-sm py-2 px-5">+ Ajouter</a>
</div>
<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200"><tr>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom</th>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ville</th>
            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Capacité MT</th>
            <th class="px-6 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($factories as $factory)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $factory->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $factory->city }}, {{ $factory->country }}</td>
                <td class="px-6 py-4"><span class="text-xs {{ $factory->status === 'operational' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} px-2 py-0.5 rounded-sm">{{ $factory->status_label }}</span></td>
                <td class="px-6 py-4 text-center text-gray-500">{{ $factory->capacity_mt ? number_format($factory->capacity_mt) : '—' }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.factories.edit', $factory) }}" class="text-xs text-industrial hover:underline mr-3">Modifier</a>
                    <form action="{{ route('admin.factories.destroy', $factory) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Aucune usine.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
