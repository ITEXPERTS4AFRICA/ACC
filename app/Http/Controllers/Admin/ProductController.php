<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', ['products' => Product::orderBy('order')->get()]);
    }
    public function create()
    {
        return view('admin.products.form', ['product' => new Product]);
    }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $slug = Str::slug($data['name']);

        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('products', 'public');
        if ($request->hasFile('pdf_datasheet'))
            $data['pdf_datasheet'] = $request->file('pdf_datasheet')->store('pdfs', 'public');
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produit créé.');
    }
    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image ?? '');
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        if ($request->hasFile('pdf_datasheet')) {
            Storage::disk('public')->delete($product->pdf_datasheet ?? '');
            $data['pdf_datasheet'] = $request->file('pdf_datasheet')->store('pdfs', 'public');
        }
        $product->update($data);
        return back()->with('success', 'Produit mis à jour.');
    }
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image ?? '');
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé.');
    }

    public function storeVariant(Request $request, Product $product)
    {
        $v = $request->validate([
            'name' => 'required|string|max:200',
            'code' => 'nullable|string|max:100',
            'type' => 'nullable|in:natural,alkalized',
            'badge' => 'nullable|string|max:100',
        ]);
        $variants = $product->variants ?? [];
        $variants[] = $v;
        $product->update(['variants' => $variants]);
        return back()->with('success', 'Variante ajoutée.');
    }

    public function destroyVariant(Product $product, int $idx)
    {
        $variants = $product->variants ?? [];
        array_splice($variants, $idx, 1);
        $product->update(['variants' => array_values($variants)]);
        return back()->with('success', 'Variante supprimée.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:200',
            'name_en' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_full' => 'nullable|string',
            'description_full_en' => 'nullable|string',
            'image' => 'nullable|image|max:6144',
            'pdf_datasheet' => 'nullable|file|mimes:pdf|max:10240',
            'order' => 'integer|min:0',
            'active' => 'boolean',
        ]);
    }
}
