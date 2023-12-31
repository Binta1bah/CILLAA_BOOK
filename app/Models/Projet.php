<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'image',
        'objectif',
        'description',
        'echeance',
        'budget',
        'etat',
        'categorie_id',
        'user_id',
    ];

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
