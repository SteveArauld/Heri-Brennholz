<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotificationMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function __construct(private Cart $cart)
    {
    }

    public function index()
    {
        $items = $this->cart->items();
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Ihr Warenkorb ist leer.');
        }

        return view('checkout.index', ['items' => $items]);
    }

    public function store(Request $request)
    {
        $items = $this->cart->items();
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Ihr Warenkorb ist leer.');
        }

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:200'],
            'address_2' => ['nullable', 'string', 'max:200'],
            'city' => ['required', 'string', 'max:120'],
            'postcode' => ['required', 'string', 'regex:/^\d{4}$/'],
            'country' => ['required', 'string', Rule::in(['Schweiz', 'Liechtenstein'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = Order::create([
            ...$data,
            'reference' => 'BOIRE-' . strtoupper(Str::random(8)),
            'status' => 'pending',
            'subtotal' => $this->cart->subtotal(),
            'shipping' => $this->cart->shipping(),
            'total' => $this->cart->total(),
            'currency' => 'CHF',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'name' => $item['product']->name,
                'price' => $item['product']->price,
                'quantity' => $item['quantity'],
                'line_total' => $item['line_total'],
            ]);
        }

        $this->cart->clear();

        $order->load('items');
        $this->sendOrderMails($order);

        return redirect()->route('checkout.confirmation', $order->reference);
    }

    /**
     * Bestätigung an den Kunden + Benachrichtigung an die Bestellannahme.
     * Ein Mailfehler darf den Bestellabschluss nicht verhindern.
     */
    private function sendOrderMails(Order $order): void
    {
        try {
            Mail::to($order->email, $order->full_name)
                ->send(new OrderConfirmationMail($order));
        } catch (\Throwable $e) {
            Log::error('Bestellbestätigung an Kunden fehlgeschlagen', [
                'order' => $order->reference, 'error' => $e->getMessage(),
            ]);
        }

        try {
            Mail::to(config('mail.admin.address'), config('mail.admin.name'))
                ->send(new NewOrderNotificationMail($order));
        } catch (\Throwable $e) {
            Log::error('Bestellbenachrichtigung an Admin fehlgeschlagen', [
                'order' => $order->reference, 'error' => $e->getMessage(),
            ]);
        }
    }

    public function confirmation(Order $order)
    {
        $order->load('items');

        return view('checkout.confirmation', compact('order'));
    }
}
