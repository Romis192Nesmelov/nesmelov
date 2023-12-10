<link href="{{ asset('css/docs.css') }}" rel="stylesheet" type="text/css">
<h1 class="head">Дополнительное соглашение №{{ $item->convention_number ? $item->convention_number : '___' }}</h1>
<p class="sub-head">
    @include('docs.blocks._contract_number_block', ['task' => $item])
</p>
@include('docs.blocks._date_table_block', ['date' => $item->convention_date])
<p>@include('docs.blocks._intro_block', ['customer' => $item->customer, 'taxType' => $item->tax_type]) в дальнейшем вместе или раздельно именуемые как «Стороны» или «Сторона», заключили настоящее Дополнительное соглашение №{{ $item->convention_number ? $item->convention_number : '___' }} (далее – Дополнительное соглашение) @include('docs.blocks._contract_number_block', ['task' => $item]) на выполнение работ (далее – Договор) о нижеследующем:</p>
<ul>
    <li>Исполнитель по поручению Заказчика обязуется выполнить работы в соответствие с нижеприведенным перечнем (далее - Работы), а Заказчик обязуется принять Работы и оплатить их в соответствие с условиями настоящего Дополнительного соглашения:</li>
    <li>Работы выполняются в один этап до {{ $item->completion_time ? date('d.m.Y',$item->completion_time) : view('docs._unknown_date_block')->render() }}</li>
</ul>
@include('docs.blocks._bill_table_block',['task' => $item, 'useTotal' => false, 'fullVal' => true])
<ul>
    <li>Общая стоимость Работ по настоящему Дополнительному соглашению составляет @include('docs.blocks._task_value_money_format_block',['task' => $item, 'fullVal' => true]) руб. (@include('docs.blocks._task_value_words_format_block',['task' => $item, 'fullVal' => true])). Услуги НДС не облагаются.</li>
    <li>Оплата Заказчиком услуг по настоящему Дополнительному соглашению производится в следующем порядке:
        @if ($item->paid_off)
            <ol>
                <li>Заказчик производит предоплату в размере {{ Helper::moneyFormat($item->paid_off) }}р. ({{ Helper::ruNumScript($item->paid_off) }} рублей, 00 копеек) течение 10 рабочих дней с момента выставления счета Исполнителем.</li>
                <li>После оказания Исполнителем Услуг указанных в данном Дополнительном соглашении и после подписания сторонами Акта оказанных услуг. Заказчик оплачивает оставшуюся сумму в размере {{ Helper::moneyFormat(Helper::calculateOverTaskVal($item) - $item->paid_off) }}р. ({{ Helper::ruNumScript(Helper::calculateOverTaskVal($item) - $item->paid_off) }} рублей 00 копеек).</li>
            </ol>
        @else
            <br>после оказания Исполнителем Услуг указанных в данном Дополнительном соглашении и после подписания сторонами Акта оказанных услуг, Заказчик оплачивает полную сумму в размере @include('docs.blocks._task_value_money_format_block',['task' => $item, 'fullVal' => false]) руб. (@include('docs.blocks._task_value_words_format_block',['task' => $item, 'fullVal' => false])).
        @endif
    </li>
    <li>Для выполнения своих обязательств по настоящему Дополнительному соглашению Исполнитель может пользоваться услугами третьих сторон, привлекать их к непосредственному оказанию Услуг.</li>
    <li>Исполнитель имеет право выполнить свои обязательства по настоящему Дополнительному соглашению досрочно. В этом случае Заказчик может досрочно принять и оплатить Услуги в соответствие с условиями настоящего Дополнительного соглашения.</li>
    <li>Настоящее Дополнительное соглашение вступает в силу с момента подписания и действует до окончания срока действия Договора.</li>
    <li>Настоящее Дополнительное соглашение является составной и неотъемлемой частью Договора, который действует в части, не противоречащей настоящему Дополнительному соглашению.</li>
    <li>Настоящее Дополнительное соглашение составлено в двух экземплярах по одному для каждой из Сторон.</li>
</ul>