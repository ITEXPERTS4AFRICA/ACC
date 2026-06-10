<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function index() { return view('admin.certifications.index', ['certifications' => Certification::orderBy('order')->get()]); }
    public function create() { return view('admin.certifications.form', ['certification' => new Certification]); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|string|max:200','name_en'=>'nullable|string|max:200','description'=>'nullable|string','description_en'=>'nullable|string','logo'=>'nullable|image|max:2048','pdf'=>'nullable|file|mimes:pdf|max:10240','order'=>'integer|min:0','active'=>'boolean']);
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('certifications','public');
        if ($request->hasFile('pdf')) $data['pdf'] = $request->file('pdf')->store('pdfs','public');
        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('success','Certification créée.');
    }
    public function edit(Certification $certification) { return view('admin.certifications.form', compact('certification')); }
    public function update(Request $request, Certification $certification) {
        $data = $request->validate(['name'=>'required|string|max:200','name_en'=>'nullable|string|max:200','description'=>'nullable|string','description_en'=>'nullable|string','logo'=>'nullable|image|max:2048','pdf'=>'nullable|file|mimes:pdf|max:10240','order'=>'integer|min:0','active'=>'boolean']);
        if ($request->hasFile('logo')) { Storage::disk('public')->delete($certification->logo ?? ''); $data['logo'] = $request->file('logo')->store('certifications','public'); }
        if ($request->hasFile('pdf')) { Storage::disk('public')->delete($certification->pdf ?? ''); $data['pdf'] = $request->file('pdf')->store('pdfs','public'); }
        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success','Certification mise à jour.');
    }
    public function destroy(Certification $certification) {
        Storage::disk('public')->delete($certification->logo ?? '');
        Storage::disk('public')->delete($certification->pdf ?? '');
        $certification->delete();
        return redirect()->route('admin.certifications.index')->with('success','Certification supprimée.');
    }
}
