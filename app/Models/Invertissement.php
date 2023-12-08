<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invertissement extends Model
{
    use HasFactory;


    protected $fillable = [
        'montant',
        'description',
        'status',
        'user_id',
        'projet_id'
    ];
    public function User() {
        return $this->belongsTo(User::class);
    }

   

}
