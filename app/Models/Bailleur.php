<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bailleur extends Model
{
    use HasFactory;


    public function invertissements()
    {
        return $this->belongsToMany(Invertissement::class);
    }
}
