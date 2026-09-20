@extends('layouts.omniva')

@section('title', 'Bestellung')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Bestellung abschließen'])

    <section class="flat-spacing-9">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('checkout.store') }}" method="POST" class="row">
                @csrf
                <div class="col-lg-7">
                    <h6 class="mb-3">Kontakt- &amp; Lieferdaten</h6>
                    <div class="row g-3">
                        <div class="col-md-6"><input class="form-control" name="first_name" placeholder="Vorname *" value="{{ old('first_name') }}" required></div>
                        <div class="col-md-6"><input class="form-control" name="last_name" placeholder="Nachname *" value="{{ old('last_name') }}" required></div>
                        <div class="col-md-6"><input class="form-control" type="email" name="email" placeholder="E-Mail *" value="{{ old('email') }}" required></div>
                        <div class="col-md-6"><input class="form-control" name="phone" placeholder="Telefon" value="{{ old('phone') }}"></div>
                        <div class="col-12"><input class="form-control" name="address" placeholder="Adresse *" value="{{ old('address') }}" required></div>
                        <div class="col-12"><input class="form-control" name="address_2" placeholder="Adresszusatz" value="{{ old('address_2') }}"></div>
                        <div class="col-md-4"><input class="form-control" name="postcode" placeholder="PLZ *" pattern="\d{4}" maxlength="4" value="{{ old('postcode') }}" required></div>
                        <div class="col-md-4"><input class="form-control" name="city" placeholder="Stadt *" value="{{ old('city') }}" required></div>
                        <div class="col-md-4">
                            <input type="hidden" name="country" value="Schweiz">
                            <input class="form-control" value="Schweiz" disabled>
                        </div>
                        <div class="col-12"><textarea class="form-control" name="notes" rows="3" placeholder="Anmerkungen (optional)">{{ old('notes') }}</textarea></div>
                    </div>
                    <h6 class="mt-4 mb-3">Zahlungsart</h6>
                    <div class="d-flex flex-column gap-2">
                        @foreach (payment_methods() as $key => $label)
                            <label class="d-flex align-items-center gap-2">
                                <input type="radio" name="payment_method" value="{{ $key }}" {{ old('payment_method', array_key_first(payment_methods())) === $key ? 'checked' : '' }} required>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                        <p class="text-caption opacity-75 mb-0">Nach Bestelleingang erhalten Sie die Zahlungsdetails bzw. die Rechnung per E-Mail.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div style="border:1px solid #ece7e1;border-radius:12px;padding:24px;">
                        <h6 class="mb-3">Ihre Bestellung</h6>
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between mb-2 text-caption">
                                <span>{{ $item['product']->name }} × {{ $item['quantity'] }}</span>
                                <span>{{ swiss_money($item['line_total']) }}</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2"><span>Zwischensumme</span><span>{{ swiss_money($cart->subtotal()) }}</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Versand</span><span>{{ $cart->shipping() > 0 ? swiss_money($cart->shipping()) : 'Kostenlos' }}</span></div>
                        <div class="d-flex justify-content-between fw-semibold h6"><span>Gesamt</span><span>{{ swiss_money($cart->total()) }}</span></div>
                        <div class="d-flex justify-content-between text-caption opacity-75"><span>Darin enthaltene MWST ({{ rtrim(rtrim(number_format(config('shop.vat_rate'), 1), '0'), '.') }} %)</span><span>{{ swiss_money(vat_included($cart->total())) }}</span></div>
                        <button type="submit" class="tf-btn btn-fill animate-btn w-100 mt-3"><span>Bestellung bestätigen</span></button>
                        <p class="text-caption mt-2 opacity-75">Alle Preise in CHF, inklusive gesetzlicher Mehrwertsteuer.</p>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
