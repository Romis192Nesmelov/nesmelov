<?php

use Illuminate\Database\Seeder;
use App\Bill;

class BillsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['number' => 130,'date' => 1560591506,'status' => 1,'user_id' => 1,'task_id' => 1],
        ];

        foreach ($data as $bill) {
            Bill::create($bill);
        }
    }
}