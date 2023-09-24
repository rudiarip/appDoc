<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'pasiens';
    
    protected $fillable = [
        'no_kartu',
        'no_hp',
        'alamat',
    ];

    public function pasiensDetails()
    {
        return $this->hasMany(PasienDetail::class, 'id_pasien', 'id');
    }
}
