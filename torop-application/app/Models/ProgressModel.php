<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressModel extends Model
{
    protected $table = 'progress';
    protected $primaryKey = 'pg_id';
    protected $fillable =
    [
        'kd_project',
        'pg_periode',
        'pg_progres',
        'pg_act_cost',
        'pg_outstanding_issues',
        'encrypt_time',
        'uuid'
    ];

    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo('App\Project', 'kd_project', 'kd_project');
    }
}
