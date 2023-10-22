<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCleaning extends Model
{
    use HasFactory;

    protected $table = 'roomcleanings';

    protected $fillable = ['idkamar', 'idstaff', 'tanggaldibersihkan'];

    public function petugas(){
        return $this->hasOne(User::class, 'id', 'idstaff');
    }

    public function kamar(){
        return $this->hasOne(Rooms::class, 'id', 'idkamar');
    }
}
