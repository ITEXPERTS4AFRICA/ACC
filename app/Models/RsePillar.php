<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RsePillar extends Model {
    protected $fillable = ['title','title_en','content','content_en','icon','order'];
    public function scopeOrdered($q) { return $q->orderBy('order'); }
    public function getTitleLocaleAttribute(): string {
        return app()->getLocale() === 'en' && $this->title_en ? $this->title_en : $this->title;
    }
    public function getContentLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->content_en ? $this->content_en : $this->content;
    }
}
