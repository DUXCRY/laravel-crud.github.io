<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{

    protected $table = 'projects';
    protected $primaryKey = 'kd_project';
    protected $fillable =
    [
        'kd_project',
        'cs_id',
        'pj_nama',
        'pj_pic',
        'pj_nilai_kontrak',
        'pj_tgl_mulai',
        'pj_tgl_selesai',
        'pj_status',
        'encrypt_time',
        'uuid'
    ];
    protected $guarded = [];
    public $incrementing = false;

    public function progress()
    {
        return $this->hasMany('App\Progress', 'kd_project', 'kd_project');
    }

    public function vendors()
    {
        return $this->belongsTo('App\Customer', 'cs_id', 'cs_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'kd_project', 'kd_project');
    }
}
