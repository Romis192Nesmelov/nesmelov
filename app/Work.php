<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['name','description','full','preview','url','active','branch_id'];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}