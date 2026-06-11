<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model {
    protected $fillable = ['path','caption','caption_en','category','order','active'];
    protected $casts = ['active' => 'boolean'];
    public function scopeActive($q) { return $q->where('active', true)->orderBy('order'); }
}
