<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model {
    protected $fillable = ['name','title','title_en','bio','bio_en','quote','quote_en','photo','is_director','order'];
    protected $casts = ['is_director' => 'boolean'];
    public function scopeOrdered($q) { return $q->orderBy('order'); }
}
