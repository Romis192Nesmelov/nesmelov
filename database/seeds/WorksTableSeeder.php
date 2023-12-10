<?php

use Illuminate\Database\Seeder;
use App\Work;

class WorksTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Web
            [
                'name' => 'Endospheres therapy',
                'description' => 'Endospheres therapy® – компрессионная микровибрация',
                'preview'  => 'images/portfolio/web/endospheres.jpg',
                'active' => true,
                'url' => 'http://www.endospherestherapy.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'КПК «Дом Сбережений»',
                'description' => 'Промо-лендинг кредитного потребительского кооператива «Дом Сбережений»',
                'preview'  => 'images/portfolio/web/dom-sber.jpg',
                'active' => true,
                'url' => 'http://dom-sber.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Apollomotors',
                'description' => 'Сайт сервисного центра Apollomotors',
                'preview'  => 'images/portfolio/web/apollomotors.jpg',
                'active' => true,
                'url' => 'http://apollomotors.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'КПК «НИВА»',
                'description' => 'Промо-лендинг кредитного потребительского кооператива «НИВА»',
                'preview'  => 'images/portfolio/web/kpk-niva.jpg',
                'active' => true,
                'url' => 'http://kpkniva.ru',
                'branch_id' => 2
            ],
            [
                'name' => 'Ломбард Т.чка',
                'description' => 'Сайт сети ломбардов «Точка»',
                'preview'  => 'images/portfolio/web/tochka.jpg',
                'active' => true,
                'url' => 'http://lombard-tochka.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Tessart',
                'description' => 'Лендинг рекламного агентства Tessart',
                'preview'  => 'images/portfolio/web/tessart.jpg',
                'active' => true,
                'url' => 'http://tessart.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Студия окон',
                'description' => 'Промо-лендинг студии про производству и продаже деревянных окон «Студия окон»',
                'preview'  => 'images/portfolio/web/studia-okon.jpg',
                'active' => true,
                'url' => 'http://window-studio.nescom.site/',
                'branch_id' => 2
            ],
            [
                'name' => 'Saindtech',
                'description' => 'Сайт аргентинской компании Saindtech',
                'preview'  => 'images/portfolio/web/saindtech.jpg',
                'active' => true,
                'url' => 'http://saindtech.com/',
                'branch_id' => 2
            ],
            [
                'name' => 'MyRealCoin',
                'description' => 'Сервис облачного майнинга MyRealCoin',
                'preview'  => 'images/portfolio/web/myrealcoin.jpg',
                'active' => true,
                'url' => 'http://myrealcoin.site/',
                'branch_id' => 2
            ],
            [
                'name' => 'Inzhsisystem Ltd.',
                'description' => 'Лендинг компании компании по привлечению инвестиций в программу развития энергосбережения в России.',
                'preview'  => 'images/portfolio/web/inzhsystems.jpg',
                'active' => true,
                'url' => 'http://www.inzhsystems.eu/',
                'branch_id' => 2
            ],
            [
                'name' => 'Торговый дом DIOMILK',
                'description' => 'Сайт торгово дома DIOMILK по производству и продаже сухого молока',
                'preview'  => 'images/portfolio/web/diomilk.jpg',
                'active' => true,
                'url' => 'http://diomilk.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Июль',
                'description' => 'Лендинг агентства программ лояльности «Июль» (новая версия)',
                'preview'  => 'images/portfolio/web/july.jpg',
                'active' => true,
                'url' => 'http://july-group.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Июль',
                'description' => 'Лендинг агентства программ лояльности «Июль» (старая версия)',
                'preview'  => 'images/portfolio/web/july-old.jpg',
                'active' => true,
                'url' => 'http://old-july.nescom.site/',
                'branch_id' => 2
            ],
            [
                'name' => 'Водный атлас',
                'description' => 'Оборудование для систем водоснабжения и водоотведения. Компания «Водный атлас»',
                'preview'  => 'images/portfolio/web/water_atlas.jpg',
                'active' => true,
                'url' => 'http://water-atlas.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'World history',
                'description' => 'Сайт проекта справочного исторического портала World history',
                'preview'  => 'images/portfolio/web/world-history.jpg',
                'active' => true,
                'url' => 'http://www.world-history.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Genie',
                'description' => 'Промо-лендинг квестовой инди-игры',
                'preview'  => 'images/portfolio/web/keliarstudio.jpg',
                'active' => true,
                'url' => 'http://genie.nescom.site/',
                'branch_id' => 2
            ],
            [
                'name' => 'Rukna',
                'description' => 'Сайт компании Rukna по производству и продаже деревянных окон',
                'preview'  => 'images/portfolio/web/rukna.jpg',
                'active' => true,
                'url' => 'https://rukna.ru/',
                'branch_id' => 2
            ],
            [
                'name' => 'Dekor Technology',
                'description' => 'Сайт компании Dekor Technology по изготовлению декораций и обеспечением различных мероприятий',
                'preview'  => 'images/portfolio/web/dekor-technology.jpg',
                'active' => true,
                'url' => 'http://www.dtechnology.ru/',
                'branch_id' => 2
            ],
            
            // 3D
            [
                'name' => 'Три башни',
                'description' => 'HoReCa диспенсер «Три башни»',
                'full'  => 'images/portfolio/3d/three_banks_full.jpg',
                'preview'  => 'images/portfolio/3d/three_banks_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Мечел',
                'description' => 'Выставочный стенд угольной компании «Мечел»',
                'full'  => 'images/portfolio/3d/mechel_full.jpg',
                'preview'  => 'images/portfolio/3d/mechel_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Чистая линия',
                'description' => 'Модель флакона шампуня «Чистая линия»',
                'full'  => 'images/portfolio/3d/clear_line_full.jpg',
                'preview'  => 'images/portfolio/3d/clear_line_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Пятый океан',
                'description' => 'Модель бутыки питьевой воды «Пятый океан»',
                'full'  => 'images/portfolio/3d/fifth_ocean_full.jpg',
                'preview'  => 'images/portfolio/3d/fifth_ocean_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Стенд Glance Avionics',
                'description' => 'Выставочный стенд компании Glance Avionics',
                'full'  => 'images/portfolio/3d/ga_stand_full.jpg',
                'preview'  => 'images/portfolio/3d/ga_stand_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Стойка Gallo',
                'description' => 'Торговая стойка компании Gallo. Оливковое масло',
                'full'  => 'images/portfolio/3d/gallo1_full.jpg',
                'preview'  => 'images/portfolio/3d/gallo1_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Паллет Gallo',
                'description' => 'Торговый паллет компании Gallo. Оливковое масло',
                'full'  => 'images/portfolio/3d/gallo2_full.jpg',
                'preview'  => 'images/portfolio/3d/gallo1_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Постеры Glance Avionics',
                'description' => 'Имиджевые постеры компании Glance Avionics',
                'full'  => 'images/portfolio/3d/glance_avionics_posters_full.jpg',
                'preview'  => 'images/portfolio/3d/glance_avionics_posters_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Коробка чая Lipton',
                'description' => 'Модель коробки чая Lipton',
                'full'  => 'images/portfolio/3d/lipton_full.jpg',
                'preview'  => 'images/portfolio/3d/lipton_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Sony Road Show',
                'description' => 'Дизайн мобильного промо-павильона SONY ROAD SHOW',
                'full'  => 'images/portfolio/3d/road_show_full.jpg',
                'preview'  => 'images/portfolio/3d/road_show_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Памятник Русский бисквит',
                'description' => 'Дизайн промо-пятника компании «Русский Бисквит»',
                'full'  => 'images/portfolio/3d/russian_bisquite_full.jpg',
                'preview'  => 'images/portfolio/3d/russian_bisquite_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Русское море',
                'description' => 'Холодильник-витрина для бренда «Русское Море»',
                'full'  => 'images/portfolio/3d/russian_sea_full.jpg',
                'preview'  => 'images/portfolio/3d/russian_sea_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Блистеры Sony v.1',
                'description' => 'Дизайн торгового дисплей для блистеров SONY MEMORY STICK',
                'full'  => 'images/portfolio/3d/sony_blisters1_full.jpg',
                'preview'  => 'images/portfolio/3d/sony_blisters1_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Блистеры Sony v.2',
                'description' => 'Дизайн торгового дисплей для блистеров SONY MEMORY STICK',
                'full'  => 'images/portfolio/3d/sony_blisters2_full.jpg',
                'preview'  => 'images/portfolio/3d/sony_blisters2_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Ресепшен Sony',
                'description' => 'Дизайн ресепшена для промо брендов SONY BRAVIA и Cybershot',
                'full'  => 'images/portfolio/3d/sony_reception_full.jpg',
                'preview'  => 'images/portfolio/3d/sony_reception_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Промо-стенд для Intel SONY VAIO',
                'description' => 'Дизайн модульного промо-стенда для Intel SONY VAIO',
                'full'  => 'images/portfolio/3d/vaio1_full.jpg',
                'preview'  => 'images/portfolio/3d/vaio1_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Стойка Sony VAIO',
                'description' => 'Дизайн промо-стенда для Sony VAIO и аксессуаров',
                'full'  => 'images/portfolio/3d/vaio2_full.jpg',
                'preview'  => 'images/portfolio/3d/vaio2_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            [
                'name' => 'Промо-мини-стенд Xperia Touch',
                'description' => 'Дизайн промо-мини-стенда Xperia Touch',
                'full'  => 'images/portfolio/3d/xperia_touch_full.jpg',
                'preview'  => 'images/portfolio/3d/xperia_touch_preview.jpg',
                'active' => true,
                'branch_id' => 3
            ],
            
            // Brand id
            [
                'name' => 'Saindtech',
                'description' => 'Логотип аргентинской компании South America Industrial Technologies',
                'full'  => 'images/portfolio/brand_id/saindtech_full.jpg',
                'preview'  => 'images/portfolio/brand_id/saindtech_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Amtorg',
                'description' => 'Логотип аргентинской компании Amtorg',
                'full'  => 'images/portfolio/brand_id/amtorg_full.jpg',
                'preview'  => 'images/portfolio/brand_id/amtorg_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Diomilk',
                'description' => 'Логотип торгового дома Diomilk',
                'full'  => 'images/portfolio/brand_id/diomilk_full.jpg',
                'preview'  => 'images/portfolio/brand_id/diomilk_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Glance Avionics Military',
                'description' => 'Логотип оборонного отдела компании Glance Avionics',
                'full'  => 'images/portfolio/brand_id/ga_military_full.jpg',
                'preview'  => 'images/portfolio/brand_id/ga_military_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Academy BMW',
                'description' => 'Логотип авто-салона Academy BMW',
                'full'  => 'images/portfolio/brand_id/academy_bmw_full.jpg',
                'preview'  => 'images/portfolio/brand_id/academy_bmw_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Codepeckers',
                'description' => 'Логотип программер-группы Сodepeckers',
                'full'  => 'images/portfolio/brand_id/codepeckers_full.jpg',
                'preview'  => 'images/portfolio/brand_id/codepeckers_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'PolyNote',
                'description' => 'Логотип программер-группы PolyNote',
                'full'  => 'images/portfolio/brand_id/polynote_full.jpg',
                'preview'  => 'images/portfolio/brand_id/polynote_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Dragons',
                'description' => 'Логотип онлайн-игры «Драконы. Возрождение легенды»',
                'full'  => 'images/portfolio/brand_id/dragons_full.jpg',
                'preview'  => 'images/portfolio/brand_id/dragons_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Frenzy-club',
                'description' => 'Логотип проекта авторских футболок Frenzy-club',
                'full'  => 'images/portfolio/brand_id/frenzy-club_full.jpg',
                'preview'  => 'images/portfolio/brand_id/frenzy-club_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Hok-S',
                'description' => 'Логотип компании по застройке выставочных стендов «Хок-С»',
                'full'  => 'images/portfolio/brand_id/hok-s_full.jpg',
                'preview'  => 'images/portfolio/brand_id/hok-s_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'KF-Expo',
                'description' => 'Логотип компании по застройке выставочных стендов KF-Expo',
                'full'  => 'images/portfolio/brand_id/kf-expo_full.jpg',
                'preview'  => 'images/portfolio/brand_id/kf-expo_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'MyRealCoin',
                'description' => 'Логотип проекта облачного майнинга MyRealCoin',
                'full'  => 'images/portfolio/brand_id/myrealcoin_full.jpg',
                'preview'  => 'images/portfolio/brand_id/myrealcoin_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],[
                'name' => 'Первое дело',
                'description' => 'Логотип консалтинговой компании «Первое дело»',
                'full'  => 'images/portfolio/brand_id/pervoe_delo_full.jpg',
                'preview'  => 'images/portfolio/brand_id/pervoe_delo_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Студия окон',
                'description' => 'Логотип студии про производству и продаже деревянных окон «Студия окон»',
                'full'  => 'images/portfolio/brand_id/studia_okon_full.jpg',
                'preview'  => 'images/portfolio/brand_id/studia_okon_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'В образе',
                'description' => 'Логотип студии красоты «В образе»',
                'full'  => 'images/portfolio/brand_id/v_obraze_full.jpg',
                'preview'  => 'images/portfolio/brand_id/v_obraze_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Мacuflex',
                'description' => 'Логотип компании по производству вакуумной упаковки Vacuflex',
                'full'  => 'images/portfolio/brand_id/vacuflex_full.jpg',
                'preview'  => 'images/portfolio/brand_id/vacuflex_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Funzay!',
                'description' => 'Логотип игрового портала Funzay!',
                'full'  => 'images/portfolio/brand_id/funzay_full.jpg',
                'preview'  => 'images/portfolio/brand_id/funzay_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],
            [
                'name' => 'Grand question',
                'description' => 'Логотип онлайн-проекта по обмену знаниями Grand Question',
                'full'  => 'images/portfolio/brand_id/grand_question_full.jpg',
                'preview'  => 'images/portfolio/brand_id/grand_question_preview.jpg',
                'active' => true,
                'branch_id' => 4
            ],

            // Polygraphy
            [
                'name' => 'Авигоризонты',
                'description' => 'Лефлет «Авигоризонты» для компании Frontline Avionics',
                'preview'  => 'images/portfolio/polygraphy/air_horizon_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/air_horizon.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Бюллетень МСРС',
                'description' => 'Информационный бюллетень Международного Совета Российских Соотечественников',
                'preview'  => 'images/portfolio/polygraphy/billuten_msrs_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/billuten_msrs.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Ежедневник HYTPRO',
                'description' => 'Ежедневник HYTPRO с тематикой Международного чемпионата мира по фублолу 2018',
                'preview'  => 'images/portfolio/polygraphy/calendar_book_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/calendar_book.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Справочник МСРС',
                'description' => 'Справочник организаций Международного Совета Российских Соотечественников',
                'preview'  => 'images/portfolio/polygraphy/directory1_msrs_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/directory1_msrs.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Справочные материалы МСРС',
                'description' => 'Справочные материалы МСРС',
                'preview'  => 'images/portfolio/polygraphy/directory2_msrs_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/directory2_msrs.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Каталог Glance Avionics',
                'description' => 'Каталог продукции компании Glance Avionics',
                'preview'  => 'images/portfolio/polygraphy/ga_catalogue_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/ga_catalogue.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Листовки Glance Avionics',
                'description' => 'Серия листовок Glance Avionics',
                'preview'  => 'images/portfolio/polygraphy/ga_flyers_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/ga_flyers.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Инструкция по установке Glance Avionics',
                'description' => 'Инструкция по установке оборудования Glance Avionics',
                'preview'  => 'images/portfolio/polygraphy/ga_install_manual_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/ga_install_manual.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Руководство пилота Glance Avionics',
                'description' => 'Руководство пилота Glance Avionics',
                'preview'  => 'images/portfolio/polygraphy/ga_pilots_guide_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/ga_pilots_guide.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Технический каталог Glance Avionics',
                'description' => 'Технический каталог Glance Avionics',
                'preview'  => 'images/portfolio/polygraphy/ga_pilots_guide_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/ga_pilots_guide.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Лефлет «Интервенция»',
                'description' => 'Лефлет выставки современного искусства «Интервенция»',
                'preview'  => 'images/portfolio/polygraphy/intervention_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/intervention.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Каталог «Корунд-М»',
                'description' => 'Каталог продукции «Корунд-М»',
                'preview'  => 'images/portfolio/polygraphy/korund-m_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/korund-m.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Коллективный договор «Кварц групп»',
                'description' => 'Коллективный договор «Кварц групп»',
                'preview'  => 'images/portfolio/polygraphy/quartz_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/quartz.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Брощюра Rukna',
                'description' => 'Брощюра Rukna',
                'preview'  => 'images/portfolio/polygraphy/rukna_brochure_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/rukna_brochure.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Буклет «Первый полет»',
                'description' => 'Буклет пилотажной группы «Первый полет»',
                'preview'  => 'images/portfolio/polygraphy/the_first_flight_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/the_first_flight.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Буклет WEN',
                'description' => 'Буклет WEN',
                'preview'  => 'images/portfolio/polygraphy/wen_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/wen.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Буклет «БиТри»',
                'description' => 'Буклет зимних садов «БиТри»',
                'preview'  => 'images/portfolio/polygraphy/wintergarten_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/wintergarten.pdf',
                'active' => true,
                'branch_id' => 5
            ],
            [
                'name' => 'Буклет Zumba Fitness',
                'description' => 'Буклет Zumba Fitness',
                'preview'  => 'images/portfolio/polygraphy/zumba_preview.jpg',
                'url'  => 'images/portfolio/polygraphy/zumba.pdf',
                'active' => true,
                'branch_id' => 5
            ],
        ];

        foreach ($data as $news) {
            Work::create($news);
        }
    }
}