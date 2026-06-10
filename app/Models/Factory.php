<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model {
    protected $fillable = ['name','name_en','city','country','capacity_mt','status','description','description_en','image','lat','lng','order','active'];
    protected $casts = ['active' => 'boolean'];

    public function getNameLocaleAttribute(): string {
        return app()->getLocale() === 'en' && $this->name_en ? $this->name_en : $this->name;
    }
    public function getDescriptionLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->description_en ? $this->description_en : $this->description;
    }
    public function getStatusLabelAttribute(): string {
        return match($this->status) {
            'operational'  => __('En opération'),
            'construction' => __('En construction'),
            'planned'      => __('Planifié'),
            default        => $this->status,
        };
    }
    public function scopeActive($q) { return $q->where('active', true)->orderBy('order'); }
}
