<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invertissement extends Model
{
    use HasFactory;

    public function projet() {
        return $this->belongsTo(Projet::class);
    }

    public function bailleur() {
        return $this->belongsTo(Bailleur::class);
    }

}
