<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Pasien extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'no_kartu',
        'no_hp',
        'alamat',
    ];
    protected $with = ['pasienDetail'];

    public function pasienDetail()
    {
        return $this->hasMany(PasienDetail::class, 'id_pasien', 'id');
    }
}
