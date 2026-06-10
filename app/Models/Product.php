<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['name','name_en','slug','description','description_en','description_full','description_full_en','image','variants','specifications','pdf_datasheet','order','active'];
    protected $casts = ['active' => 'boolean', 'variants' => 'array', 'specifications' => 'array'];

    public function getNameLocaleAttribute(): string {
        return app()->getLocale() === 'en' && $this->name_en ? $this->name_en : $this->name;
    }
    public function getDescriptionLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->description_en ? $this->description_en : $this->description;
    }
    public function getDescriptionFullLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->description_full_en ? $this->description_full_en : $this->description_full;
    }
    public function scopeActive($q) { return $q->where('active', true)->orderBy('order'); }
}
