<p style="width: 50%;">
    <b>Получатель:</b> {{ $taxType ? 'ИП ' : '' }}Несмелов Роман Сергеевич<br>
    <b>ИНН:</b> {{ Settings::getRequisites()['tin'] }}<br>
    @if ($taxType)
        <b>Руководитель:</b> Несмелов Роман Сергеевич<br>
    @endif
    <b>Банк получателя:</b> {{ $taxType ? Settings::getRequisites()['bank_ie'] : Settings::getRequisites()['bank_se'] }}<br>
    <b>БИК:</b> {{ $taxType ? Settings::getRequisites()['bank_id_ie'] : Settings::getRequisites()['bank_id_se'] }}<br>
    <b>Счет №:</b> {{ $taxType ? Settings::getRequisites()['checking_account_ie'] : Settings::getRequisites()['checking_account_se'] }}<br>
    <b>Кор. счет №:</b> {{ $taxType ? Settings::getRequisites()['correspondent_account_ie'] : Settings::getRequisites()['correspondent_account_se'] }}
</p>