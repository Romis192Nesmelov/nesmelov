<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use Sluggable;

    protected $fillable = [
        'slug',
        'name',
        'email',
        'phone',
        'contact_person',
        'type',
        'description',
        
        'save_contract',
        'contract',
        
        'contract_number',
        'contract_date',
        'ltd',
        'director',
        'director_case',
        'address',
        'ogrn',
        'okpo',
        'okved',
        'oktmo',
        'inn',
        'kpp',
        'payment_account',
        'correspondent_account',
        'bank_id'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'maxLength' => null,
                'maxLengthKeepWords' => true,
                'method' => null,
                'separator' => '-',
                'unique' => true,
                'uniqueSuffix' => null,
                'includeTrashed' => false,
                'reserved' => null,
                'onUpdate' => false
            ]
        ];
    }

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function userTasks()
    {
        return $this->hasMany('App\Task')->where('user_id', Auth::id())->orWhere('owner_id', Auth::id());
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
}