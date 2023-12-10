<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['status','task_id'];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}