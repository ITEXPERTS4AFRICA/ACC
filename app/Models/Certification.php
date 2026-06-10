<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model {
    protected $fillable = ['name','name_en','description','description_en','logo','pdf','order','active'];
    protected $casts = ['active' => 'boolean'];
    public function scopeActive($q) { return $q->where('active', true)->orderBy('order'); }
    public function getNameLocaleAttribute(): string {
        return app()->getLocale() === 'en' && $this->name_en ? $this->name_en : $this->name;
    }
    public function getDescriptionLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->description_en ? $this->description_en : $this->description;
    }
}
