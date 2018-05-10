<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class SeminarProposal extends Model
{
    const ACTION_LULUS = 1;
    const ACTION_GAGAL = 0;
    protected $fillable = [
        "mahasiswa_id", "schedule", "creator_id", "passed", "evaluator_id", "proposal_id", "id_dosen_penguji", "id_dosen_pembimbing_1",
        "id_dosen_pembimbing_2"
    ];

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function evaluator()
    {
        return $this->belongsTo('App\User', 'evaluator_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'id');
    }

    public function dosen_pembimbing_1()
    {
        return $this->belongsTo('App\Dosen','id_dosen_pembimbing_1','id');
    }
    public function dosen_pembimbing_2()
    {
        return $this->belongsTo('App\Dosen','id_dosen_pembimbing_2','id');
    }
    public function dosen_penguji()
    {
        return $this->belongsTo('App\Dosen','id_dosen_penguji','id');
    }
}
