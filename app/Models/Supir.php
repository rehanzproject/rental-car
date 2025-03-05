<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $attributes = [
        'supir_photo' => '',
        'status' => 'Tersedia'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
