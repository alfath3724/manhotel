<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = ['nmpenyewa', 'jenisidentitas', 'noidentitas', 'idstaff', 'idkamar', 'checkin', 'checkout'];

    public function kamar(){
        return $this->hasOne(Rooms::class, 'id', 'idkamar');
    }

    public function petugas(){
        return $this->hasOne(User::class, 'id', 'idstaff');
    }
}
