<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index() {
        return view('admin.partners.index', ['partners' => Partner::orderBy('order')->get()]);
    }
    public function create() {
        return view('admin.partners.form', ['partner' => new Partner]);
    }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|string|max:200','logo'=>'nullable|image|max:2048','website'=>'nullable|url|max:300','order'=>'integer|min:0','active'=>'boolean']);
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('partners', 'public');
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partenaire créé.');
    }
    public function edit(Partner $partner) {
        return view('admin.partners.form', compact('partner'));
    }
    public function update(Request $request, Partner $partner) {
        $data = $request->validate(['name'=>'required|string|max:200','logo'=>'nullable|image|max:2048','website'=>'nullable|url|max:300','order'=>'integer|min:0','active'=>'boolean']);
        if ($request->hasFile('logo')) { Storage::disk('public')->delete($partner->logo ?? ''); $data['logo'] = $request->file('logo')->store('partners', 'public'); }
        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partenaire mis à jour.');
    }
    public function destroy(Partner $partner) {
        Storage::disk('public')->delete($partner->logo ?? '');
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partenaire supprimé.');
    }
}
