<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Дом сбережений','email' => 'obuhov_iy@mail.ru','phone' => '+7(926)009-25-29','contact_person' => 'Обухов Игорь Юрьевич','type' => 1],
            ['name' => 'КПК Нива','email' => 'kpkniva@protonmail.com','phone' => '+7(701)788-34-66','contact_person' => 'Нурлан Мухамеджанов','type' => 2],
            ['name' => 'Ломбарт Т.чка','email' => 'kellervalentin77@gmail.com','phone' => '+7(985)828-77-88','contact_person' => 'Валентин Келлер','type' => 2],
            ['name' => 'Apollomotors','email' => 'taran@apollomotors.ru','phone' => '+7(925)518-58-79','contact_person' => 'Дмитрий Таран','type' => 1],
            ['name' => 'Glance Avionics','email' => 'afilimonov2000@gmail.com','phone' => '+7(916)124-26-77','contact_person' => 'Анатолий Филимонов','type' => 5],
            ['name' => 'Diomilk','email' => 'lichtenburg@mail.ru','phone' => '+7(985)928-97-49','contact_person' => 'Александр Судовых','type' => 5],
            ['name' => 'Русский бисквит','email' => 'for_mihail@list.ru','phone' => '+7(903)144-32-61','contact_person' => 'Михаил Дмитрюк','type' => 3],
            ['name' => 'KF-Expo','email' => 'kurnik0711@mail.ru','phone' => '+7(916)009-79-79','contact_person' => 'Алексей Курников','type' => 5],
            ['name' => 'Июль','email' => 'd@july.moscow','phone' => '+7(977)815-94-91','contact_person' => 'Дмитрий Белоус','type' => 2],
            ['name' => 'Rukko','email' => '','phone' => '+7(915)076-65-89','contact_person' => 'Ольга','type' => 3],
            ['name' => 'Макаров','email' => 'victor.makarov@freshmindcom.ru','phone' => '+7(916)682-60-53','contact_person' => 'Виктор Макаров','type' => 3],
            ['name' => 'Progression Group','email' => 'Shulga.S@progressiongroup.ru','phone' => '+7(909)965-59-56','contact_person' => 'Светлана Шульга','type' => 2],
            ['name' => 'Студия «Пифагор»','email' => 'rakitski@mail.ru','phone' => '+7(985)967-52-53','contact_person' => 'Дмитрий Ракитский','type' => 3],
            ['name' => 'HYTPRO','email' => 'katya@hytpro.com','phone' => '+3(725)838-37-12','contact_person' => 'Екатерина Хорошкова','type' => 3],
            ['name' => 'Tessart','email' => 'ria@tessart.ru','phone' => '+7(916)120-00-45','contact_person' => 'Игорь Ривкин','type' => 2],
            ['name' => 'Russian Throne','email' => 'for_mihail@list.ru','phone' => '+7(903)144-32-61','contact_person' => 'Михаил Дмитрюк','type' => 3],
            ['name' => 'Novikov Group','email' => 'rakitski@mail.ru','phone' => '+7(985)967-52-53','contact_person' => 'Дмитрий Ракитский','type' => 2],
            ['name' => 'iVenika','email' => 'okorob@ivenika.ru','phone' => '+7(985)440-39-83','contact_person' => 'Олег Короб','type' => 2],
            ['name' => 'Octagon','email' => 'mrudakov@octagon.moscow','phone' => '+7(926)049-12-79','contact_person' => 'Максим Рудаков','type' => 2],
            ['name' => 'Мадина','email' => 'madinatotoonova@gmail.com','phone' => '+7(965)130-50-00','contact_person' => 'Мадина Тотоонова','type' => 2]
        ];

        foreach ($data as $news) {
            Customer::create($news);
        }
    }
}