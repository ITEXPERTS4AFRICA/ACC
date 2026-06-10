@extends('layouts.admin')
@section('title', 'Produits')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $products->count() }} produit(s)</p>
    <a href="{{ route('admin.products.create') }}" class="btn-primary text-sm py-2 px-5">+ Ajouter</a>
</div>

<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Produit</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Slug</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ordre</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actif</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $product->slug }}</td>
                <td class="px-6 py-4 text-center text-gray-500">{{ $product->order }}</td>
                <td class="px-6 py-4 text-center">
                    @if($product->active)<span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-sm">Oui</span>
                    @else<span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-sm">Non</span>@endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-industrial hover:underline mr-3">Modifier</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                          onsubmit="return confirm('Supprimer ce produit ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Aucun produit.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
