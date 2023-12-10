<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BanksTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'ПАО Сбербанк',
                'bank_id' => '044525225',
            ],
            [
                'name' => 'ОАО «Альфа-Банк»',
                'bank_id' => '044525593',
            ],
            [
                'name' => 'ПАО ВТБ',
                'bank_id' => '044525187',
            ],
            [
                'name' => 'АО «ОТП Банк» ',
                'bank_id' => '044525311',
            ],
        ];

        foreach ($data as $news) {
            Bank::create($news);
        }
    }
}