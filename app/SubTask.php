<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = [
        'name',
        'value',
        'percents',
        'paid_percents',
        'status',
        'start_time',
        'completion_time',
        'description',
        'send_email',
        'task_id',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}