<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMobil extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function armadas()
    {
        return $this->hasMany(Armada::class);
    }
}
