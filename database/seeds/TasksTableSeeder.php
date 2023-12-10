<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Абонентка за январь','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1547093593, 'completion_time' => 1549793410,'customer_id' => 1,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за февраль','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1549793410,'completion_time' => 1552212610,'customer_id' => 1,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за март','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1552212610,'completion_time' => 1554891010,'customer_id' => 1,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за апрель','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1554891010,'completion_time' => 1557483010,'customer_id' => 1,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за май','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1557483010,'completion_time' => 1560161410,'customer_id' => 1,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за июнь','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1560161410,'completion_time' => 1562753410,'customer_id' => 1,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Абонентка за февраль','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1547525593,'completion_time' => 1552644610,'customer_id' => 2,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за март','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1552644610,'completion_time' => 1555323010,'customer_id' => 2,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за апрель','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555323010,'completion_time' => 1557915010,'customer_id' => 2,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за май','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1557915010,'completion_time' => 1560593410,'customer_id' => 2,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Абонентка за январь','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1546229593,'completion_time' => 1548929410,'customer_id' => 3,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за февраль','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1548929410,'completion_time' => 1551348610,'customer_id' => 3,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Абонентка за март','value' => 30000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1551348610,'completion_time' => 1554027010,'customer_id' => 3,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Разработка макета в прессу Glance Avionics 105 размером 87,5х62,5мм','value' => 1500,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1548065410,'completion_time' => 1548065410,'customer_id' => 5,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработка макета в прессу Glance Avionics 105 размером 87,5х62,5мм (повторно)','value' => 1500,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1549966210,'completion_time' => 1549966210,'customer_id' => 5,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработка макета в прессу Glance Avionics 207 размером 87,5х62,5мм','value' => 1500,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1550743810,'completion_time' => 1550743810,'customer_id' => 5,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработка макета в прессу Glance Avionics 210V&210H размером 87,5х62,5мм','value' => 1500,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1550830210,'completion_time' => 1550830210,'customer_id' => 5,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработать дизайн выставочного стенда для выставки AERO 2019','value' => 4000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1550916610,'completion_time' => 1550916610,'customer_id' => 5,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработка постера 1500х1000мм','value' => 21200,'paid_off' => 0,'percents' => 10,'status' => 1,'start_time' => 1549275010,'completion_time' => 1549275010,'customer_id' => 5,'user_id' => 2,'owner_id' => 1],
            ['name' => 'Передача исходников на некоторые модели и листовки','value' => 21800,'paid_off' => 0,'percents' => 10,'status' => 1,'start_time' => 1557137410,'completion_time' => 1557137410,'customer_id' => 5,'user_id' => 1,'owner_id' => 2],
            ['name' => 'Передача исходников каталога на русском (без инфографики)','value' => 12000,'paid_off' => 0,'percents' => 10,'status' => 1,'start_time' => 1560507010,'completion_time' => 1560507010,'customer_id' => 5,'user_id' => 1,'owner_id' => 2],
        
            ['name' => 'Дизайн памятника','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1547979010,'completion_time' => 1555733593,'customer_id' => 7,'user_id' => 1,'owner_id' => 1],

            ['name' => 'Модификация сайта (добавление таблицы ремонтных работ по Audi)','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1548238210,'completion_time' => 1548238210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Модификация сайта (возможность указания пользовательских URI)','value' => 3000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1548238210,'completion_time' => 1548238210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Модификация сайта в соответствии с правками маркетолога','value' => 5000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1549015810,'completion_time' => 1549015810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Дополнительный параметр у "Акций" в виде флага "Показывать на главной"','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1549534210,'completion_time' => 1549534210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена ремня ГРМ Ford Focus2"','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1550311810,'completion_time' => 1550311810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена сцепления Ford Focus2"','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1550311810,'completion_time' => 1550311810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла АКПП Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1552731010,'completion_time' => 1552731010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена ремня ГРМ на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1552731010,'completion_time' => 1552731010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена цепи ГРМ Тигуан"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1552731010,'completion_time' => 1552731010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Форд Фокус 2 ремонт"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1552731010,'completion_time' => 1552731010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена приводного ремня на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1553681410,'completion_time' => 1553681410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена тормозных колодок на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1553681410,'completion_time' => 1553681410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена амортизаторов на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1553681410,'completion_time' => 1553681410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1553681410,'completion_time' => 1553681410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена ремня ГРМ на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена салонного фильтра на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена свечей на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена цепи ГРМ на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена кондиционера на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена лампочек на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555409410,'completion_time' => 1555409410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла ДВС на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555409410,'completion_time' => 1555409410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Шкода Йети"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555409410,'completion_time' => 1555409410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена амортизаторов на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556273410,'completion_time' => 1556273410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена и ремонт генератора на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556273410,'completion_time' => 1556273410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла АКПП на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556273410,'completion_time' => 1556273410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена тормозной жидкости на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556273410,'completion_time' => 1556273410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена тормозных колодок на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556273410,'completion_time' => 1556273410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Шкода Кодиак"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556273410,'completion_time' => 1556273410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Генерация sitemap.xml из админки','value' => 3000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555409410,'completion_time' => 1555409410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Плакат 1250х130','value' => 2000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1556446210,'completion_time' => 1556446210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла ДВС на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558087810,'completion_time' => 1558087810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена ремня ГРМ на Шкода Фабия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558087810,'completion_time' => 1558087810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена ступицы на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558087810,'completion_time' => 1558087810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена тормозных дисков  на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558087810,'completion_time' => 1558087810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена цепи ГРМ на Шкода Йети"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558087810,'completion_time' => 1558087810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Шкода Суперб"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558087810,'completion_time' => 1558087810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "Замена масла ДВС на Шкода Йети"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558865410,'completion_time' => 1558865410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "Замена приводного ремня на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558865410,'completion_time' => 1558865410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "Замена пружин подвески на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558865410,'completion_time' => 1558865410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "Замена радиатора на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558865410,'completion_time' => 1558865410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "Компьютерная диагностика на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558865410,'completion_time' => 1558865410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "ТО на Шкода Фабия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558865410,'completion_time' => 1558865410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка старницы "ТО на Шкода"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1548238210,'completion_time' => 1548238210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена и ремонт двигателя на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла ДВС на Шкода Кодиак"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена сцепления на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена термостата на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена тормозных колодок на Шкода Кодиак"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Поло Седан"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Тигуан"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559470210,'completion_time' => 1559470210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Верстка страницы "Замена и ремонт АКПП на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561111810,'completion_time' => 1561111810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена помпы на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561111810,'completion_time' => 1561111810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена свечей на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561111810,'completion_time' => 1561111810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена цепи ГРМ на Шкода Фабия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561111810,'completion_time' => 1561111810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Гольф"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561111810,'completion_time' => 1561111810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Пассат"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561111810,'completion_time' => 1561111810,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена воздушного фильтра на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561803010,'completion_time' => 1561803010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена сайлентблоков на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561803010,'completion_time' => 1561803010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена стоек стабилизатора на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561803010,'completion_time' => 1561803010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена ШРУСа или привода на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561803010,'completion_time' => 1561803010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Туарег"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561803010,'completion_time' => 1561803010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1561803010,'completion_time' => 1561803010,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена антифриза на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562321410,'completion_time' => 1562321410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла МКПП на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562321410,'completion_time' => 1562321410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Ремонт Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562321410,'completion_time' => 1562321410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Амарок"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562321410,'completion_time' => 1562321410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Джетта"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562321410,'completion_time' => 1562321410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Джетта"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562321410,'completion_time' => 1562321410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла МКПП на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена помпы на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена топливного фильтра на Шкода Октавия"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Компьютерная диагностика на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Кади"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Крафтер"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена воздушного фильтра на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена лампочек на Шкода Йети"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена масла Халдекс на Шкода Йети"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена салонного фильтра на Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Замена цепи ГРМ на Шкода Суперб"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "Ремонт Шкода Рапид"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Поло"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Верстка страницы "ТО на Фольксваген Транспортер"','value' => 250,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1563790210,'completion_time' => 1563790210,'customer_id' => 4,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Создание визиток HOK-S','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1548324610,'completion_time' => 1548324610,'customer_id' => 8,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Создание кнопок для чат-бота','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1549275010,'completion_time' => 1549275010,'customer_id' => 9,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Создание фейковой картинки рассылки','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1553681410,'completion_time' => 1553681410,'customer_id' => 9,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Создание кнопки для чат-бота','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1559556610,'completion_time' => 1559556610,'customer_id' => 9,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Программинг сайта','value' => 67000,'paid_off' => 48000,'percents' => 0,'status' => 2,'start_time' => 1550895193,'completion_time' => 1571134210,'customer_id' => 10,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Доработка какого-то кривого сайта','value' => 1000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1550398210,'completion_time' => 1550398210,'customer_id' => 11,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Разработка HTML-баннера «Naturals с белыми грибами» 240x400','value' => 5000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1568110210,'completion_time' => 1568110210,'customer_id' => 12,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработка HTML-баннера «Naturals с белыми грибами» 240x400','value' => 5000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1568110210,'completion_time' => 1568110210,'customer_id' => 12,'user_id' => 1,'owner_id' => 1],
            ['name' => 'Разработка CRM «Visa-Qiwi»','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1563768793,'completion_time' => 1568110210,'customer_id' => 12,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Студия «Пифагор»','value' => 1500,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1555236610,'completion_time' => 1555236610,'customer_id' => 13,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Верстка ежедневника','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1554783193,'completion_time' => 1554891010,'customer_id' => 14,'user_id' => 1,'owner_id' => 1],
                
            ['name' => 'Переделка лендинга','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1570270210,'completion_time' => 1570270210,'customer_id' => 15,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Модель кресла','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1558325593,'completion_time' => 1563012610,'customer_id' => 16,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Визуализация и подготовка макетов для пакетов','value' => 15000,'paid_off' => 0,'percents' => 0,'status' => 3,'start_time' => 1561695193,'completion_time' => 1568974210,'customer_id' => 17,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Создание лендинга inzhsystems','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 1,'start_time' => 1562753410,'completion_time' => 1562753410,'customer_id' => 18,'user_id' => 1,'owner_id' => 1],
        
            ['name' => 'Создание html-баннеров Сбербанка','value' => 10000,'paid_off' => 0,'percents' => 0,'status' => 2,'start_time' => 1562904793,'completion_time' => 1564999810,'customer_id' => 19,'user_id' => 1,'owner_id' => 1],
        ];

        foreach ($data as $news) {
            Task::create($news);
        }
    }
}