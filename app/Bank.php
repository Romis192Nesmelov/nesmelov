<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['name','bank_id'];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}