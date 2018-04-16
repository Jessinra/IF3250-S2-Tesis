<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //
    const STATUS_PROPOSAL_DIAJUKAN = 0;
    const STATUS_PROPOSAL_DITERIMA = 1;
    const STATUS_PROPOSAL_DITOLAK = -1;

    const ACTION_PROPOSAL_DITERIMA = 1;
    const ACTION_PROPOSAL_DITOLAK = 0;
    protected $fillable=[
        "mahasiswa_id","path","filesize","filename"
    ];
    const STATUS_STRING = [
        0 => 'Proposal telah diajukan.',
        1 => 'Proposal  diterima',
        -1 => 'Proposal ditolak'
    ];
    function human_filesize( $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;
        $size = $this->filesize;
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
        return round($size, $precision).$units[$i];
    }

    function evaluator() {
        return $this->belongsTo('App\User', 'evaluator_id', 'id');
    }

    function getStatusString() {
        return Proposal::STATUS_STRING[$this->status];
    }
}
