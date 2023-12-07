<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invertissements()
    {
        return $this->belongsToMany(Invertissement::class);
    }

    public function categories()
    {
        return $this->belongsTo(Projet::class);
    }
}
