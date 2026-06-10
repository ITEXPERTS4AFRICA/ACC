<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model {
    protected $fillable = ['name','email','company','country','subject','message','read'];
    protected $casts = ['read' => 'boolean'];
}
