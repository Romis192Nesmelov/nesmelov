<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['icon','eng','rus','image','description','text','full_portfolio','active'];

    public function works()
    {
        return $this->hasMany('App\Work');
    }
}