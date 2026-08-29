<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_subscription_create()
    {
        $response = $this->get(route('subscription.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_free_user_can_access_subscription_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('subscription.create'));

        $response->assertStatus(200);
    }

    public function test_premium_user_cannot_access_subscription_create()
    {
        $user = User::factory()->create();
        $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create('pm_card_visa');

        $response = $this->actingAs($user)->get(route('subscription.create'));

        $response->assertRedirect(route('subscription.edit'));
    }

    public function test_admin_cannot_access_subscription_create()
    {
        $admin = new Admin();
        $admin->name= '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->actingAs($admin, 'admin')->get(route('subscription.create'));

        $response->assertRedirect(route('admin.home'));
    }

    public function test_guest_cannot_access_subscription_store()
    {
        $request_parameter = [
            'paymentMethodId' => 'pm_card_visa'
        ];

        $response = $this->post(route('subscription.store'), $request_parameter);

        $response->assertRedirect(route('login'));
    }

    public function test_free_user_can_access_subscription_store()
    {
        $user = User::factory()->create();

        $request_parameter = [
            'paymentMethodId' => 'pm_card_visa'
        ];

        $response = $this->actingAs($user)->post(route('subscription.store'), $request_parameter);

        $response->assertRedirect(route('home'));

        $user->refresh();
        $this->assertTrue($user->subscribed('premium_plan'));
    }

    public function test_premium_user_cannot_access_subscription_store()
    {
        $user = User::factory()->create();
        $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create('pm_card_visa');

        $request_parameter = [
            'paymentMethodId' => 'pm_card_visa'
        ];

        $response = $this->actingAs($user)->post(route('subscription.store'), $request_parameter);

        $response->assertRedirect(route('subscription.edit'));
    }

    public function test_admin_cannot_access_subscription_store()
    {
        $admin = new Admin();
        $admin->name= '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $request_parameter = [
            'paymentMethodId' => 'pm_card_visa'
        ];

        $response = $this->actingAs($admin, 'admin')->post(route('subscription.store'), $request_parameter);

        $response->assertRedirect(route('admin.home'));
    }

    public function test_guest_cannot_access_subscription_edit()
    {
        $response = $this->get(route('subscription.edit'));

        $response->assertRedirect(route('login'));
    }

    public function test_free_user_cannot_access_subscription_edit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('subscription.edit'));

        $response->assertRedirect(route('subscription.create'));
    }

    public function test_premium_user_can_access_subscription_edit()
    {
        $user = User::factory()->create();
        $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create('pm_card_visa');

        $response = $this->actingAs($user)->get(route('subscription.edit'));

        $response->assertStatus(200);
    }

    public function test_admin_cannot_access_subscription_edit()
    {
        $admin = new Admin();
        $admin->name= '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->actingAs($admin, 'admin')->get(route('subscription.edit'));

        $response->assertRedirect(route('admin.home'));
    }

    public function test_guest_cannot_access_subscription_update()
    {
        $request_parameter = [
            'paymentMethodId' => 'pm_card_mastercard'
        ];

        $response = $this->patch(route('subscription.update'), $request_parameter);

        $response->assertRedirect(route('login'));
    }

    public function test_free_user_cannot_access_subscription_update()
    {
        $user = User::factory()->create();

        $request_parameter = [
            'paymentMethodId' => 'pm_card_mastercard'
        ];

        $response = $this->actingAs($user)->patch(route('subscription.update'), $request_parameter);

        $response->assertRedirect(route('subscription.create'));
    }

    public function test_premium_user_can_access_subscription_update()
    {
        $user = User::factory()->create();
        $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create('pm_card_visa');

        $original_payment_method_id = $user->defaultPaymentMethod()->id;

        $request_parameter = [
            'paymentMethodId' => 'pm_card_mastercard'
        ];

        $response = $this->actingAs($user)->patch(route('subscription.update'), $request_parameter);

        $response->assertRedirect(route('home'));

        $user->refresh();
        $this->assertNotEquals($original_payment_method_id, $user->defaultPaymentMethod()->id);
    }

    public function test_admin_cannot_access_subscription_update()
    {
        $admin = new Admin();
        $admin->name= '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $request_parameter = [
            'paymentMethodId' => 'pm_card_mastercard'
        ];

        $response = $this->actingAs($admin, 'admin')->patch(route('subscription.update'), $request_parameter);

        $response->assertRedirect(route('admin.home'));
    }

    public function test_guest_cannot_access_subscription_cancel()
    {
        $response = $this->get(route('subscription.cancel'));

        $response->assertRedirect(route('login'));
    }

    public function test_free_user_cannot_access_subscription_cancel()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('subscription.cancel'));

        $response->assertRedirect(route('subscription.create'));
    }

    public function test_premium_user_can_access_subscription_cancel()
    {
        $user = User::factory()->create();
        $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create('pm_card_visa');

        $response = $this->actingAs($user)->get(route('subscription.cancel'));

        $response->assertStatus(200);
    }

    public function test_admin_cannot_access_subscription_cancel()
    {
        $admin = new Admin();
        $admin->name= '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->actingAs($admin, 'admin')->get(route('subscription.cancel'));

        $response->assertRedirect(route('admin.home'));
    }

    public function test_guest_cannot_access_subscription_destroy()
    {
        $response = $this->delete(route('subscription.destroy'));

        $response->assertRedirect(route('login'));
    }

    public function test_free_user_cannot_access_subscription_destroy()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('subscription.destroy'));

        $response->assertRedirect(route('subscription.create'));
    }

    public function test_premium_user_can_access_subscription_destroy()
    {
        $user = User::factory()->create();
        $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create('pm_card_visa');

        $response = $this->actingAs($user)->delete(route('subscription.destroy'));

        $response->assertRedirect(route('home'));

        $user->refresh();
        $this->assertFalse($user->subscribed('premium_plan'));
    }

    public function test_admin_cannot_access_subscription_destroy()
    {
        $admin = new Admin();
        $admin->name= '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->actingAs($admin, 'admin')->delete(route('subscription.destroy'));

        $response->assertRedirect(route('admin.home'));
    }
}