<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicApproval extends Model
{
    //
    const ACTION_TOLAK = -1;
    const ACTION_TERIMA = 1;
    protected $fillable=[
        'mahasiswa_id',
        'manajer_id',
        'topic_id',
        'action'
    ];

    public function topic() {
        return $this->belongsTo('App\Topic');
    }
    public function manajer() {
        return $this->belongsTo('App\Manajer');
    }
}
