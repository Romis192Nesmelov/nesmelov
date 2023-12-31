<?php

use Illuminate\Database\Seeder;
use App\Question;
use Illuminate\Support\Facades\Settings;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'question' => 'С чего начинается работа над новым проектом?',
                'answer' => '
                    <p>Мы обговариваем будущий проект. Очень желательно чтобы лично. С менеджером заказчика или с самим заказчиком, но обязательно словами. Это нужно для того, что бы не только мы поняли, что именно хочет заказчик, и как он это видит, но чтобы и сам заказчик это понял сам для себя. И возможно что-то додумал и прояснил.</p>
                    <p> Очень часто в процессе обсуждения мы можем что-то предложить, навести на мысль, с ходу предложить варианты, исходя из опыта, или наоборот, заказчик проговаривая свою идею, сам лучше ее представит в уме и лучше донесет до нас.</p>
                    <p>Небольшие проекты, конечно, можно обговорить просто по телефону. Для крупных – предпочтительнее личная встреча. Мы можем подъехать в офис заказчика или просто встретиться где-то на третьей стороне, например в каком-нибудь кафе.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Какие предусмотренны юридические аспекты работы над проектом?',
                'answer' => '
                    <p>Очень желательно подписать официальный договор. Если заказчик не может этого сделать (у него нет юр.лица или по каким-то причинам он не хочет этого делать), то это надо оговаривать отдельно.</p>
                    <p>Мы всегда стараемся работать официально, при этом налоги берем на себя – заказчик платит только оговоренную сумму по договору.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Необходима ли предоплата для начала работы?',
                'answer' => '
                    <p>На все проекты предоплата 30-50%. Работы над проектом могут начаться раньше предоплаты, но предоплата обязательна.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Сколько вариантов дизайн-концепций вы предоставляете?',
                'answer' => '
                    <p>Всегда предоставляется не менее 3-4 вариантов. НЕ менее, но возможно и более, на наше усмотрение (что называется, как пойдет креатив).</p>
                    <p>Далее заказчик выбирает 1-3 из предложенных вариантов, и мы дорабатываем их с учетом пожеланий и правок, постепенно снижая количество отобранных вариантов. Т.е., если на первом этапе отобраны были 3 варианта, то на втором их количество мы сокращаем до 2, и в финале до одного.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Какое количество правок можно вносить в проект?',
                'answer' => '
                    <p>На кадом этапе доработки дизайн-концепции доспустимо вносить не менее 3-5 правок. Иногда мы сами предлагаем что-то изменить, если считаем, что так будет лучше.</p>
                    <p>Но мы НЕ приветствуем работу с бесконечным количеством правок. У нас есть глубокая убежденность в том, что работа, строящаяся по принципу «чем быстрее мы вносим правки, тем быстрее клиент придумывает новые» никому не нужна и может осуществляться только для эмуляции рабочего процесса. В этом же самом нас убеждает многолетний опыт работы на рекламном рынке. Если у заказчика возникли сомнения в правильности выбранного им варианта и направления дальнейшей разработки, мы всегда можем пойти на встречу и обсудить «возврат» к какой-то из «веток», но не надо вносить правки ради правок. В этом случае, мы оставляем за собой право прекратить дальнейшее сотрудничество, без возврата предоплаты.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Как происходит работа над web-проектом?',
                'answer' => '
                    <p>Если работа по созданию сайта, лендинга, api или другая web-разработка, то клиент должен сам зарегистрировать хостинг и домен и/или предоставить доступы к панели регистратора доменного имени и хостингу. Наши специалисты могут помочь в регистации заказчику консультациями и инструкциями, но очевидно, что домен и хостинг должны быть зарегистрированны на владельца, а не на исполнителя проекта.</p>
                    <p>В процессе разработки, мы поднимаем тестовую площадку, на которой производим всю разработку, с демонстрацией промежуточных результатов заказчику. После окончательного утверждения – все переносится на боевой хостинг и домен заказчика и ему предоставляются все доступы в админку проекта.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Предусмотренна ли поддержка и обслуживание завершенного web-проекта?',
                'answer' => '
                    <p>Поддержка и дальнейшее обслуживание web-проекта оговариваются отдельно.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Как происходит работа над проектом c использованием 3D-моделирования и анимации?',
                'answer' => '
                    <p>Поскольку чистовой рендер практически всегда трудоемкий и продолжительный по времени процесс, то перед его началом мы предоставляем на утверждение драфт-рендеры, то-есть, визуализацию в низком разрешении. И только после утверждения заказчиком приступаем к чистовым рендерам.</p> 
                    <p>По этой же причине в стоимость проекта будет включена стоимость машинного времени рендера.</p>
                ',
                'active' => true
            ],
            [
                'question' => 'Как происходит завершение проекта?',
                'answer' => '
                    <p>После окончательного утверждения проекта, мы готовим закрывающие документы (если мы работаем по договору) и заказчик перечисляет остаток суммы.</p>
                    <p>Оригиналы документов обычно пересылаем курьером или привозим лично, что называется с оказией.</p>
                ',
                'active' => true
            ],
        ];

        foreach ($data as $slide) {
            Question::create($slide);
        }
    }
}