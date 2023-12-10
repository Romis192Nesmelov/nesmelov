<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersUpdateTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'contract_number' => null,
                'contract_date' => 1536139354,
                'ltd' => 1,
                'director' => 'Обухов Игор Юрьевич',
                'director_case' => 'Обухова Игоря Юрьевича',
                'address' => '105005, г. Москва,  улица Бакунинская, д.17/28, помещение XVII',
                'ogrn' => '5177746217721',
                'okpo' => '20235366',
                'okved' => null,
                'oktmo' => null,
                'inn' => '9729168086',
                'kpp' => null,
                'payment_account' => '40701810638000001877',
                'correspondent_account' => '30101810400000000225',
                'bank_id' => 1
            ],
            [
                'id' => 4,
                'contract_number' => '02-R/2017',
                'contract_date' => 1509528154,
                'ltd' => 1,
                'director' => 'Таран Дмитрий Владимирович',
                'director_case' => 'Тарана Дмитрия Владимировича',
                'address' => '121471, г. Москва, ул. Рябиновая, д.43, корп. 1',
                'ogrn' => '1117746498957',
                'okpo' => '92542631',
                'okved' => null,
                'oktmo' => null,
                'inn' => '7729685482',
                'kpp' => '772901001',
                'payment_account' => '40702810800420000362',
                'correspondent_account' => '30101810000000000311',
                'bank_id' => 4
            ],
            [
                'id' => 12,
                'name' => 'Прогрешен',
                'contract_number' => '010819-1',
                'contract_date' => 1546950021,
                'ltd' => 1,
                'director' => 'Глаголева Оксана Глебовна',
                'director_case' => 'Глаголевой Оксаны Глебовны',
                'address' => '109029, г. Москва, Сибирский проезд, дом 2, стр. 11, эт/ком 3/3',
                'ogrn' => '1087746798370',
                'okpo' => null,
                'okved' => null,
                'oktmo' => null,
                'inn' => '7725641460 ',
                'kpp' => '770901001',
                'payment_account' => '40702810600040000747',
                'correspondent_account' => '30101810700000000187',
                'bank_id' => 3
            ],
            [
                'id' => 14,
                'contract_number' => '25-08-19 ИП',
                'contract_date' => 1610108421,
                'ltd' => 1,
                'director' => 'Хорошкова Екатерина Юрьевна',
                'director_case' => 'Хорошковой Екатерины Юрьевны',
                'address' => '119017, г, Москва, Лаврушинский пер., дом 17, стр. 4, помещение Х',
                'ogrn' => null,
                'okpo' => null,
                'okved' => null,
                'oktmo' => null,
                'inn' => '1734403790',
                'kpp' => '770601001',
                'payment_account' => '40702810202570002645',
                'correspondent_account' => '30101810200000000593',
                'bank_id' => 2
            ],
        ];
        
        foreach ($data as $item) {
            $id = $item['id'];
            unset($item['id']);
            Customer::where('id',$id)->update($item);
        }
    }
}