@extends('layouts.omniva')

@section('title', 'Bestellung bestätigt')

@section('content')
    @include('partials.page-title', ['pageTitle' => 'Vielen Dank für Ihre Bestellung'])

    <section class="flat-spacing-9">
        <div class="container" style="max-width:720px;">
            <div class="text-center mb-4">
                <div class="h4">Bestellung <strong>{{ $order->reference }}</strong> eingegangen</div>
                <p class="opacity-75">Eine Bestätigung wurde an {{ $order->email }} gesendet.</p>
            </div>

            <div style="border:1px solid #ece7e1;border-radius:12px;padding:24px;">
                <table class="table">
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->name }} × {{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format((float) $item->line_total, 2, ',', ' ') }} €</td>
                            </tr>
                        @endforeach
                        <tr><td>Zwischensumme</td><td class="text-end">{{ number_format((float) $order->subtotal, 2, ',', ' ') }} €</td></tr>
                        <tr><td>Versand</td><td class="text-end">{{ $order->shipping > 0 ? number_format((float) $order->shipping, 2, ',', ' ').' €' : 'Kostenlos' }}</td></tr>
                        <tr class="fw-semibold"><td>Gesamtbetrag</td><td class="text-end">{{ number_format((float) $order->total, 2, ',', ' ') }} €</td></tr>
                    </tbody>
                </table>
                <p class="mb-1"><strong>Lieferadresse:</strong> {{ $order->first_name }} {{ $order->last_name }}, {{ $order->address }}@if($order->address_2), {{ $order->address_2 }}@endif, {{ $order->postcode }} {{ $order->city }}, {{ $order->country }}</p>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('shop.index') }}" class="tf-btn btn-fill animate-btn"><span>Zurück zum Shop</span></a>
            </div>
        </div>
    </section>
@endsection
