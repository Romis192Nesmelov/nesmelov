<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'number',
        'date',
        'status',
        'send_email',
        'signing',
        'user_id',
        'task_id',

        'save_act',
        'act',
        'save_bill',
        'bill',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}