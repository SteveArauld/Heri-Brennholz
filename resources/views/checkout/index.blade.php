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
                        <div class="col-md-4"><input class="form-control" name="postcode" placeholder="Postleitzahl *" value="{{ old('postcode') }}" required></div>
                        <div class="col-md-4"><input class="form-control" name="city" placeholder="Stadt *" value="{{ old('city') }}" required></div>
                        <div class="col-md-4"><input class="form-control" name="country" placeholder="Land *" value="{{ old('country', 'Deutschland') }}" required></div>
                        <div class="col-12"><textarea class="form-control" name="notes" rows="3" placeholder="Anmerkungen (optional)">{{ old('notes') }}</textarea></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div style="border:1px solid #ece7e1;border-radius:12px;padding:24px;">
                        <h6 class="mb-3">Ihre Bestellung</h6>
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between mb-2 text-caption">
                                <span>{{ $item['product']->name }} × {{ $item['quantity'] }}</span>
                                <span>{{ number_format($item['line_total'], 2, ',', ' ') }} €</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2"><span>Zwischensumme</span><span>{{ number_format($cart->subtotal(), 2, ',', ' ') }} €</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Versand</span><span>{{ $cart->shipping() > 0 ? number_format($cart->shipping(), 2, ',', ' ').' €' : 'Kostenlos' }}</span></div>
                        <div class="d-flex justify-content-between fw-semibold h6"><span>Gesamt</span><span>{{ number_format($cart->total(), 2, ',', ' ') }} €</span></div>
                        <button type="submit" class="tf-btn btn-fill animate-btn w-100 mt-3"><span>Bestellung bestätigen</span></button>
                        <p class="text-caption mt-2 opacity-75">Zahlung bei Lieferung / per Rechnung (Demo).</p>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
