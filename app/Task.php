<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'contact_person',
        'value',
        'paid_off',
        'percents',
//        'my_percent',
        'paid_percents',
        'use_duty',
        'status',
        'start_time',
        'completion_time',
        'payment_time',
        'description',

        'convention_number',
        'convention_date',
        'save_convention',
        'convention',
        'tax_type',

        'send_email',
        'customer_id',
        'user_id',
        'owner_id'
    ];

    
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }

    public function subTasks()
    {
        return $this->hasMany('App\SubTask','task_id');
    }
    
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    public function statistics()
    {
        return $this->hasMany('App\Statistic');
    }
}