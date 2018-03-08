<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ROLE_MAHASISWA = "Mahasiswa";
    const ROLE_DOSEN = "Dosen";
    const ROLE_MANAJER= "Manajer";

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isManajer() {
        return Manajer::find($this->id);
    }
    public function isDosen() {
        return Dosen::find($this->id);
    }

    public function isMahasiswa() {
        return Mahasiswa::find($this->id);
    }
}
