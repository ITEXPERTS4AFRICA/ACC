<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FactoryController extends Controller
{
    public function index() {
        $factories = Factory::orderBy('order')->get();
        return view('admin.factories.index', compact('factories'));
    }
    public function create() { return view('admin.factories.form', ['factory' => new Factory]); }
    public function store(Request $request) {
        $data = $this->validate($request);
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('factories','public');
        Factory::create($data);
        return redirect()->route('admin.factories.index')->with('success','Usine créée.');
    }
    public function edit(Factory $factory) { return view('admin.factories.form', compact('factory')); }
    public function update(Request $request, Factory $factory) {
        $data = $this->validate($request);
        if ($request->hasFile('image')) { Storage::disk('public')->delete($factory->image ?? ''); $data['image'] = $request->file('image')->store('factories','public'); }
        $factory->update($data);
        return redirect()->route('admin.factories.index')->with('success','Usine mise à jour.');
    }
    public function destroy(Factory $factory) {
        Storage::disk('public')->delete($factory->image ?? '');
        $factory->delete();
        return redirect()->route('admin.factories.index')->with('success','Usine supprimée.');
    }
    private function validate(Request $request): array {
        return $request->validate(['name'=>'required|string|max:200','name_en'=>'nullable|string|max:200','city'=>'required|string|max:100','country'=>'required|string|max:100','capacity_mt'=>'nullable|integer','status'=>'required|in:operational,construction,planned','description'=>'nullable|string','description_en'=>'nullable|string','image'=>'nullable|image|max:4096','lat'=>'nullable|numeric','lng'=>'nullable|numeric','order'=>'integer|min:0','active'=>'boolean']);
    }
}
