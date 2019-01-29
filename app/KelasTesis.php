<?php
/**
 * Created by PhpStorm.
 * User: ROG
 * Date: 4/19/2018
 * Time: 5:49 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class KelasTesis extends Model
{
    protected $table = 'kelas_tesis';
    protected $fillable = [
        'id', 'semester', 'tahun', 'id_dosen_kelas'];

    public function dosenKelas(){
        return $this->belongsTo('App\Dosen','id_dosen_kelas','id');
    }

}