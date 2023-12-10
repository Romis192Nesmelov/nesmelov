<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Несмелов Роман', 'email' => 'romis.nesmelov@gmail.com', 'phone' => '+7(926)247-77-25', 'password' => bcrypt('apg192'), 'is_admin' => true],
            ['name' => 'Юлия Белова', 'email' => 'juliabelova@inbox.ru', 'phone' => '+7 916 727-95-40', 'password' => bcrypt('juliabelova'), 'is_admin' => false],
        ];

        foreach ($data as $slide) {
            User::create($slide);
        }
    }
}