<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function porteur() {

        return $this->belongsTo(PorteurDeProjet::class);

    }

    public function invertissements() {
        return $this->belongsToMany(Invertissement::class);
    }
        

}
