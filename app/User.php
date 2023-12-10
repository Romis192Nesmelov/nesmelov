<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','phone','password','is_admin','send_email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function tasks()
    {
        return $this->hasMany('App\Task','user_id')->orderBy('id','desc');
    }

    public function ownTasks()
    {
        return $this->hasMany('App\Task','owner_id')->orderBy('id','desc');
    }
    
    public function messages()
    {
        return $this->hasMany('App\Message')->orderBy('id','desc');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill')->orderBy('id','desc');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat')->orderBy('id','desc');
    }

    public function sentEmail()
    {
        return $this->hasMany('App\SentEmail')->orderBy('id','desc');
    }
}
