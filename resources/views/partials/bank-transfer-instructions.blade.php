@php($showAccount = $showAccount ?? true)

<div style="margin-top:20px;border:1px solid #ece7e1;border-radius:12px;padding:20px 24px;">
    <h2 class="h5 mb-3">Vorkasse (Banküberweisung)</h2>

    <div class="bank-message">
        {!! \App\Support\SiteTexts::html('bank.message_html') !!}
    </div>

    @if($showAccount && \App\Support\SiteTexts::hasBankDetails())
        <dl class="mb-0 mt-3 p-3" style="background:#faf7f2;border:1px solid #ece5da;border-radius:8px;">
            @foreach(['bank.holder' => 'Name', 'bank.iban' => 'IBAN', 'bank.bic' => 'BIC', 'bank.transfer_type' => 'Überweisungsart'] as $key => $label)
                @if(trim(\App\Support\SiteTexts::text($key)) !== '')
                    <div class="mb-2">
                        <dt class="text-caption opacity-75 mb-0">{{ $label }}</dt>
                        <dd class="mb-0 fw-semibold" style="word-break:break-all;">{{ \App\Support\SiteTexts::text($key) }}</dd>
                    </div>
                @endif
            @endforeach
            <div><dt class="text-caption opacity-75 mb-0">Verwendungszweck</dt><dd class="mb-0 fw-semibold">{{ $order->reference }}</dd></div>
        </dl>
    @endif
</div>
