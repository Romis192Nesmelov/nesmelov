<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    protected $fillable = [
        'email',
        'html',
        'user_id',
    ];

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}