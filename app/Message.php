<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message',
        'status',
        'active_to_owner',
        'active_to_user',
        'owner_id',
        'user_id',
        'task_id',
        'sub_task_id',
    ];

    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function subTask()
    {
        return $this->belongsTo('App\SubTask');
    }
}