<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manajer extends Model
{
    //
    protected $fillable= ['id'];

    public function user() {
        return User::find($this->id);
    }

}
