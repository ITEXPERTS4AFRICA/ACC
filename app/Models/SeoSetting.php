<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model {
    protected $fillable = ['page_key','meta_title','meta_title_en','meta_description','meta_description_en','og_image'];

    public static function forPage(string $key): ?self {
        return static::where('page_key', $key)->first();
    }
    public function getTitleLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->meta_title_en ? $this->meta_title_en : $this->meta_title;
    }
    public function getDescriptionLocaleAttribute(): ?string {
        return app()->getLocale() === 'en' && $this->meta_description_en ? $this->meta_description_en : $this->meta_description;
    }
}
