<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'url', 'id_padre'];

    protected $table = 'menu';

    public $timestamps = false;

    public function children()
    {
        return $this->hasMany(Menu::class, 'id_padre');
    }

    public function padre() {
        return $this->belongsTo(Menu::class, 'id_padre');
    }
}
