<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    private function vorkasseOrder(): Order
    {
        return Order::create([
            'reference' => 'HB-TEST1', 'first_name' => 'Anna', 'last_name' => 'Muster', 'email' => 'a@example.ch',
            'address' => 'Bahnhofstrasse 1', 'city' => 'Bern', 'postcode' => '3000', 'country' => 'Schweiz',
            'subtotal' => 100, 'shipping' => 0, 'total' => 100, 'currency' => 'CHF',
            'status' => 'pending', 'payment_method' => 'vorkasse',
        ]);
    }

    public function test_guest_and_customer_cannot_open_the_editor(): void
    {
        $this->get(route('admin.edit'))->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create(['is_admin' => false]))
            ->get(route('admin.edit'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_sign_in_edit_and_remove_bank_details(): void
    {
        $this->post(route('admin.login.submit'), [
            'email' => 'admin@rizzochristian.com',
            'password' => 'admin@23',
        ])->assertRedirect(route('admin.edit'));

        $this->get(route('admin.edit'))->assertOk()->assertSee('Message de paiement', false);

        $this->post(route('admin.update'), [
            'locale' => 'de',
            'values' => [
                ['key' => 'bank.message_html', 'value' => '<script>alert(1)</script><p>Eigener Text.</p>'],
                ['key' => 'bank.holder', 'value' => 'Neuer Inhaber'],
                ['key' => 'bank.iban', 'value' => 'CH9300762011623852957'],
            ],
        ])->assertRedirect(route('admin.edit', ['locale' => 'de']));

        $order = $this->vorkasseOrder();

        $this->get(route('checkout.confirmation', $order->reference))
            ->assertOk()
            ->assertSee('Eigener Text.', false)
            ->assertDontSee('alert(1)', false)
            ->assertSee('Neuer Inhaber', false)
            ->assertSee('CH9300762011623852957', false);

        $this->delete(route('admin.bank.destroy'))->assertRedirect(route('admin.edit'));

        $this->get(route('checkout.confirmation', $order->reference))
            ->assertOk()
            ->assertDontSee('CH9300762011623852957', false);
    }

    public function test_unknown_locale_is_rejected(): void
    {
        $admin = User::query()->where('email', 'admin@rizzochristian.com')->firstOrFail();

        $this->actingAs($admin)->from(route('admin.edit'))
            ->post(route('admin.update'), ['locale' => 'fr', 'values' => [['key' => 'bank.holder', 'value' => 'x']]])
            ->assertSessionHasErrors('locale');
    }
}
