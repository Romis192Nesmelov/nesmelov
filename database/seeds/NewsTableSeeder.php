<?php

use Illuminate\Database\Seeder;
use App\News;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'image' => 'images/news/mechel.jpg',
                'head' => 'Дизайн выставочного стенда Мечел',
                'short' => 'Создан дизайн-проект выставочного стенда для угольной компании Мечел',
                'text' => '<p>По заданию рекламного агентства Карандаш выполнен дизайн выставочного стенда для угольной компании Мечел.</p><p>3D MAX, Adobe Illustrator, Adobe Photoshop.</p>',
                'time' => 1514890592,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/endospherestherapy.jpg',
                'head' => 'Релиз сайта Endospheres Therapy®',
                'short' => 'Состоялся релиз сайта официального представительства Endospheres Therapy® (Эндосфера® терапия) в России.',
                'text' => '<p>Сам <a href="http://www.endospherestherapy.ru/" target="_blank">сайт</a> достаточно стандартен, хотя и имеет внушительный контент, регулярно пополняемый через админку, но интересен в основном своей начальной заставкой. Дело в том, что это не статичное пререндеренное видео (если не считать видео-вставок), а динамическая адаптивная верстка на основе HTML5, CSS3 и управляемая js-скриптами. Даже предусмотрено минимальное взаимодействие с пользователем – для продолжение нужно на каждом слайде прокрутить колесо мыши. Все корректно выглядит и проигрывается на любых разрешениях. Так-же все управление последовательностью слайдов, текстами и картинками предусмотрено в админке.</p>',
                'time' => 1532908801,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/july.jpg',
                'head' => 'Запушен лендинг July Group',
                'short' => 'Лендинг агентства программ лояльности July Group введен в строй',
                'text' => '<p>Не сложный бюджетный лендинг агентства программ лояльности July Group (<a href="http://july-group.ru/" target="_blank">http://july-group.ru/</a>).</p><p>Адаптивная верстка на основе bootstrap (HTML5, CSS3), backend – фреймворк Laravel 5.4.</p><p>Это уже вторая версия лендинга для July Group, первую можно увидеть <a href="http://old-july.tempo.agency/" target="_blank">тут</a>.</p>',
                'time' => 1534330592,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_tech_catalogue.jpg',
                'head' => 'Верстка технического каталога Glance Avionics',
                'short' => 'Закончена верстка технической версии каталога Glance Avionics',
                'text' => '<p>Нами был разработан дизайн обложки и макета технического каталога Glance Avionics формата А4 и прозведена его верстка на русском и <a href="/images/portfolio/polygraphy/ga_tech_catalogue.pdf" target="_blank">английском</a> языках. Каталог предназначен для распространения только в электронном виде (pdf-файл), но нами так-же была сделана и печатная его версия.</p><p>Верстка изобилует большим количеством инфографики, схем и чертежей. Все использовавшиеся в верстке имиджи продукции были созданы в виде 3D-моделей и визуализированны с помощью 3D MAX</p><p>3D MAX (mental-ray renderer), Adobe Illustrator, Adobe Photoshop, Adobe Indesing.</p>',
                'time' => 1534762592,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/dom-sber.jpg',
                'head' => 'Запушен лендинг КПК Дом сбережений',
                'short' => 'Закончено тестирование лендинга кредитного потребительского кооператива Дом сбережений',
                'text' => '<p><a href="http://dom-sber.ru/" target="_blank">Лендинг</a> включает в себя:</p>
                            <ul>
                                <li>Интерактивные калькуляторы для онлайн расчета выплат по депозитам (расчеты на основе алгоритма аннуитета), ежемесяным платежам по залогам недвижимости, автомобиля или золотых изделий;</li>
                                <li>Динамически-генерируемые страницы для печати расчетов данных кальляторов;</li>
                                <li>Онлайн-заявки на косультации, заявку на кредит, оценку золотых изделий или обратный звонок, интегрированные с системой Calltouch;</li>
                                <li>Cron-парсеры стороннего ресурса для актуализации ставок Центробанка РФ;</li>
                                <li>Новостную ленту и систему фото-альбомов.</li>                            
                            </ul>
                            <p>Управление лендингом осуществляется через страницу администратора (админку).</p>
                            <p>Адаптивная верстка на основе bootstrap (HTML5, CSS3), backend – фреймворк Laravel 5.6.</p>',
                'time' => 1536317792,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/window-studio.jpg',
                'head' => 'Запушен лендинг Студия окон',
                'short' => 'Закончен лендинг компании Студия окон по производству и продаже деревянных оконных рам',
                'text' => '<p>Бюджетный <a href="http://window-studio.nescom.site/" target="_blank">лендинг</a> с формой обратной связи, заявкой на обратный звонок и на расчет изделия, а так-же слайдером-галлереей работ. Впоследствии лендинг был помещен в архив компании, в связи с прекращением деятельности самой Студии окон.</p><p>Адаптивная верстка на основе bootstrap (HTML5, CSS3), backend – фреймворк Laravel 5.4.</p>',
                'time' => 1536317792,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_pilots_guide.jpg',
                'head' => 'Верстка руководства пилота Glance Avionics',
                'short' => 'Закончена верстка руководства для пилота по использованию приборов компании Glance Avionics',
                'text' => '<p>Компания Glance Avionics занимается проектировкой, производством и продажей различного авиационного оборудования для малой авиации: приборами контороя полета, двигателя, навигациооными приборами и прочим.</p><p>Нами был разработан дизайн и произведена верстка руководства для пилотов по эксплуатации данной продукции формата А4 на <a href="/images/portfolio/polygraphy/ga_pilots_guide.pdf" target="_blank">русском</a> и английском языках.</p><p>3D MAX (mental-ray renderer), Adobe Illustrator, Adobe Photoshop, Adobe Indesign.</p>',
                'time' => 1536490592,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_install_manual.jpg',
                'head' => 'Верстка инструкции по установке приборов Glance Avionics',
                'short' => 'Закончена инструкции по установке продукции Glance Avionics',
                'text' => '<p>Нами был разработан дизайн и произведена верстка инструкции по установке приборов компании Glance Avionics формата А4 на <a href="/images/portfolio/polygraphy/ga_install_manual.pdf" target="_blank">русском</a> и английском языках.</p><p>3D MAX (mental-ray renderer), Adobe Illustrator, Adobe Photoshop, Adobe Indesign.</p>',
                'time' => 1536404192,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_flyers.jpg',
                'head' => 'Дизайн и верстка листовок Glance Avionics',
                'short' => 'Внесены последние правки и сданы в печать макеты листовок Glance Avionics',
                'text' => '<p>Нами был разработан дизайн и произведена верстка имиджевых листовок формата А4 на <a href="/images/portfolio/polygraphy/ga_flyers.pdf" target="_blank">русском</a> и английском языках.</p><p>3D MAX (mental-ray renderer), Adobe Illustrator, Adobe Photoshop, Adobe Indesign.</p>',
                'time' => 1536663392,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/vacuflex.jpg',
                'head' => 'Создание логотипа Vacuflex',
                'short' => 'Окончательно утвержден логотип Vacuflex',
                'text' => '<p>Для компании Vacuflex, производящей и продающей различную вакуумную упаковку, нами был разработан логотип и фирменный стиль компании.</p>',
                'time' => 1537095392,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_catalogue.jpg',
                'head' => 'Дизайн и верстка каталога Glance Avionics',
                'short' => 'Создана новая обложка и закончена верстка каталога Glance Avionics',
                'text' => '<p>Компания Glance Avionics занимается проектировкой, производством и продажей различного авиационного оборудования для малой авиации: приборами контороя полета, двигателя, навигациооными приборами и прочим.</p><p>Нами был разработан дизайн обложки и макета каталога продукции формата А4 данной компании и произведена верстка на <a href="/images/portfolio/polygraphy/ga_catalogue.pdf" target="_blank">русском</a>, английском и французском языках.</p><p>Все использовавшиеся в верстке имиджи продукции были созданы в виде 3D-моделей и визуализированны с помощью 3D MAX</p><p>3D MAX (mental-ray renderer), Adobe Illustrator, Adobe Photoshop, Adobe Indesing.</p>',
                'time' => 1537872992,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/hok-s.jpg',
                'head' => 'Запушен лендинг ХОК-С',
                'short' => 'Закончен лендинг компании ХОК-С по застройке выставочных стендов',
                'text' => '<p>Еще один бюджетный лендинг с формой обратной связи и заявкой на обратный звонок, а так-же галлереей работ.</p><p>Адаптивная верстка на основе bootstrap (HTML5, CSS3), backend – фреймворк Laravel 5.6.</p>',
                'time' => 1538650592,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/niva.jpg',
                'head' => 'Запушен лендинг КПК Нива',
                'short' => 'Закончено тестирование лендинга кредитного потребительского кооператива Нива',
                'text' => '<p><a href="http://kpkniva.ru/" target="_blank">Лендинг</a> включает в себя:</p>
                            <ul>
                                <li>Интерактивные калькуляторы для онлайн расчета выплат по депозитам (расчеты на основе алгоритма аннуитета), ежемесяным платежам по залогам недвижимости, автомобиля или золотых изделий;</li>
                                <li>Динамически-генерируемые страницы для печати расчетов данных кальляторов;</li>
                                <li>Онлайн-заявки на косультации, заявку на кредит, или обратный звонок</li>
                                <li>Cron-парсеры стороннего ресурса для актуализации ставок Центробанка РФ;</li>                            
                            </ul>
                            <p>Управление лендингом осуществляется через страницу администратора (админку).</p>
                            <p>Адаптивная верстка на основе bootstrap (HTML5, CSS3), backend – фреймворк Laravel 5.6.</p>',
                'time' => 1539600992,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_military.jpg',
                'head' => 'Создание логотипа Glance Avionics Military',
                'short' => 'Закончен и окончательно утвержден логотип Glance Avionics Military',
                'text' => '<p>Компания Glance Avionics занимается проектировкой, производством и продажей различного авиационного оборудования для малой авиации: приборами контороя полета, двигателя, навигациооными приборами и прочим. Основное поле деятельности компании расположено в российском сегменте рынка, но с недавних под было образовано отдельное подразделение компании, занимающиеся экспортом технологий для зарубежных ВПК.</p><p>Нами был разработан логотип и фирменный стиль этого подразделения с учетом преемственности и узнаваемости в дизайне фирменного стиля и логотипа родительской компании (самой Glance Avionics).</p>',
                'time' => 1537872992,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/tochka.jpg',
                'head' => 'Запушен лендинг сети ломбардов Т.чка',
                'short' => 'Закончен рефакторинг и программинг лендинга сети ломбардов Т.чка',
                'text' => '<p>Изначально лендинг «Ломбард Тючка» был незаконченным проектом по созданию сайта на некой CMS. Необходимо было переработать существующую верстку с сохранением основных элементов, но с введением адаптивного перестроения под мобильные устройства, замену статичных элементов (как то: калькулятор, акции, котировки) интерактивными и ввести возможность редактирования их параметров через панель администратора (админку).</p>
                            <p><a href="http://lombard-tochka.ru/" target="_blank">Лендинг</a> включает в себя:</p>
                            <ul>
                                <li>Интерактивные калькуляторы для онлайн расчета ежемесяных платежей по различным залоговым тарифам на золотые изделия;</li>
                                <li>Онлайн-заявки на бронирование займа или обратный звонок;</li>
                                <li>Cron-парсеры стороннего ресурса для актуализации котировок золота.</li>                            
                            </ul>
                            <p>Управление лендингом осуществляется через страницу администратора (админку).</p>
                            <p>Адаптивная верстка на основе bootstrap (HTML5, CSS3), backend – фреймворк Laravel 5.6.</p>',
                'time' => 1539600992,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/russian_bisqute.jpg',
                'head' => 'Дизайн-проект памятник «Русский бисквит»',
                'short' => 'Созданы несколько дизайн-концептов памятника бисквитам или рулету для компании Русский бисквит',
                'text' => '<p>Идея создания памятников еде далеко не нова и насчитывает множество подобных монументов не только в России, но и по всему миру. В Луховицах есть памятник огурцу, в Калининградской области памятник шпротам, в Сочи памятник тыкве и т.д. Есть даже памятники вилке и ложке.</p><p>Какое-то время назад в Москве на территории завода Карат был памятник плавленному сырку Дружба в виде обнявшихся вороны и лисицы. Очевидно, вдохновившись этим творением, компания Русский бисквит решила увековечить таким обрадом и свою продукцию, соорудив подобный памятник в одной из парковых зон Череповца</p><p>Нами были разработаны несколько дизайн-проектов, но, к сожалению, проект заглох, так толком и не начавшись.</p>',
                'time' => 1547981792,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/ga_stand.jpg',
                'head' => 'Дизайн выставочного стенда Glance Avionics',
                'short' => 'Для участия в выставке Glance Avionics в выставке AERO 2019 был разработан дизайн выставочного стенда',
                'text' => '<p>Компания Glance Avionics занимается проектировкой, производством и продажей различного авиационного оборудования для малой авиации: приборами контороя полета, двигателя, навигациооными приборами и прочим.</p><p>Нами был разработан дизайн бюджетного выставочного стенда на основе профиля Октанорм для участия в выставке AERO 2019.</p><p>Все использовавшиеся в дизайне имиджи продукции были созданы в виде 3D-моделей и визуализированны с помощью 3D MAX, как и модель самого стенда.</p><p>3D MAX (mental-ray renderer), Adobe Illustrator, Adobe Photoshop.</p>',
                'time' => 1550919392,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/tessart.jpg',
                'head' => 'Запушен лендинг РА Тессарт',
                'short' => 'Закончен программинг лендинга для рекламного агентства Тессарт',
                'text' => '<p>Запущена новая версия лендинга для РА «Тессарт». Верстка без использования bootstrap, но включает в себя адаптивные компоненты для отображения на любых мобильных устройствах и любых разрешениях. Так-же присутствует админка для управления контентом.</p>',
                'time' => 1556535392,
                'active' => true,
                'important' => false
            ],
            [
                'image' => 'images/news/news_19.jpg',
                'head' => 'Запущен мини-лендинг Inzhsisystem Ltd.',
                'short' => 'Запущен совсем простой и бюджетный лендинг компании Inzhsisystem Ltd.',
                'text' => '<p>Запущен совсем простой и бюджетный лендинг <a href="http://www.inzhsystems.eu/" target="_blank">Inzhsisystem Ltd.</a> Компания занимается привлечением инвестиций в программу развития энергосбережения в России на европейском фондовом рынке. Несмотря на всю простоту и лапидарность, лендиг включает в себя форму обратной связи и админку с возможностью редактирования SEO-тегов, контента и заявок, а так-же настройки спам-фильтра. Серьезную проблему при деплое создал неведомый кипрский хостер, наотрез отказавшийся предоставлять SSH-доступ к площадке и в обще менять какие-либо настройки.</p>',
                'time' => 1563012000,
                'active' => true,
                'important' => true
            ],
        ];

        foreach ($data as $news) {
            News::create($news);
        }
    }
}