<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_shops_index()
    {
        $response = $this->get(route('admin.shops.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_user_cannot_access_admin_shops_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.shops.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_admin_shops_index()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->actingAs($admin, 'admin')->get(route('admin.shops.index'));

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_admin_shops_show()
    {
        $category = Category::create([
            'name' => '和食',
        ]);

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('admin.shops.show', $shop));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_user_cannot_access_admin_shops_show()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => '和食',
        ]);

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);


        $response = $this->actingAs($user)->get(route('admin.shops.show', $shop));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_admin_shops_show()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $category = Category::create([
            'name' => '和食',
        ]);

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);


        $response = $this->actingAs($admin, 'admin')->get(route('admin.shops.show', $shop));

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_admin_shops_create()
    {
        $response = $this->get(route('admin.shops.create'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_user_cannot_access_admin_shops_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.shops.create'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_admin_shops_create()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.shops.create'));

        $response->assertStatus(200);
    }


    public function test_guest_cannot_access_admin_shops_store()
    {
        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop_data = [
            'category_id' => $category->id,
            'name' => 'テスト店舗',
            'address' => '佐賀県佐賀市テスト1-1',
            'phone_number' => '0952123456',
            'description' => 'テスト',
            'regular_holiday' => '月曜日',
            'business_hours' => '11:00〜20:00',
            'price_range' => '3,000円〜5,000円',
        ];

        $response = $this->post(route('admin.shops.store'), $shop_data);

        $this->assertDatabaseMissing('shops', $shop_data);
        $response->assertRedirect(route('admin.login'));
    }

    public function test_user_cannot_access_admin_shops_store()
    {
        $user = User::factory()->create();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop_data = [
            'category_id' => $category->id,
            'name' => 'テスト店舗',
            'address' => '佐賀県佐賀市テスト1-1',
            'phone_number' => '0952123456',
            'description' => 'テスト',
            'regular_holiday' => '月曜日',
            'business_hours' => '11:00〜20:00',
            'price_range' => '3,000円〜5,000円',
        ];

        $response = $this->actingAs($user)
            ->post(route('admin.shops.store'), $shop_data);

        $this->assertDatabaseMissing('shops', $shop_data);
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_admin_shops_store()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop_data = [
            'category_id' => $category->id,
            'name' => 'テスト店舗',
            'address' => '佐賀県佐賀市テスト1-1',
            'phone_number' => '0952123456',
            'description' => 'テスト',
            'regular_holiday' => '月曜日',
            'business_hours' => '11:00〜20:00',
            'price_range' => '3,000円〜5,000円',
        ];

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.shops.store'), $shop_data);

        $this->assertDatabaseHas('shops', $shop_data);
        $response->assertRedirect(route('admin.shops.index'));
    }

    public function test_guest_cannot_access_admin_shops_edit()
    {
        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('admin.shops.edit', $shop));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_user_cannot_access_admin_shops_edit()
    {
        $user = User::factory()->create();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.shops.edit', $shop));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_admin_shops_edit()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.shops.edit', $shop));

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_admin_shops_update()
    {
        $category = new Category();
        $category->name = '和食';
        $category->save();

        $old_shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $new_shop_data = [
            'category_id' => $category->id,
            'name' => 'テスト更新',
            'address' => '佐賀県佐賀市テスト2-2',
            'phone_number' => '0952987654',
            'description' => 'テスト更新',
            'regular_holiday' => '火曜日',
            'business_hours' => '12:00〜21:00',
            'price_range' => '5,000円〜10,000円',
        ];

        $response = $this->patch(
            route('admin.shops.update', $old_shop),
            $new_shop_data
        );

        $this->assertDatabaseMissing('shops', $new_shop_data);
        $response->assertRedirect(route('admin.login'));
    }


    public function test_user_cannot_access_admin_shops_update()
    {
        $user = User::factory()->create();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $old_shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $new_shop_data = [
            'category_id' => $category->id,
            'name' => 'テスト更新',
            'address' => '佐賀県佐賀市テスト2-2',
            'phone_number' => '0952987654',
            'description' => 'テスト更新',
            'regular_holiday' => '火曜日',
            'business_hours' => '12:00〜21:00',
            'price_range' => '5,000円〜10,000円',
        ];

        $response = $this->actingAs($user)->patch(
            route('admin.shops.update', $old_shop),
            $new_shop_data
        );

        $this->assertDatabaseMissing('shops', $new_shop_data);
        $response->assertRedirect(route('admin.login'));
    }


    public function test_admin_can_access_admin_shops_update()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $old_shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $new_shop_data = [
            'category_id' => $category->id,
            'name' => 'テスト更新',
            'address' => '佐賀県佐賀市テスト2-2',
            'phone_number' => '0952987654',
            'description' => 'テスト更新',
            'regular_holiday' => '火曜日',
            'business_hours' => '12:00〜21:00',
            'price_range' => '5,000円〜10,000円',
        ];

        $response = $this->actingAs($admin, 'admin')->patch(
            route('admin.shops.update', $old_shop),
            $new_shop_data
        );

        $this->assertDatabaseHas('shops', $new_shop_data);

        $response->assertRedirect(route('admin.shops.index'));
    }

    public function test_guest_cannot_access_admin_shops_destroy()
    {
        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->delete(route('admin.shops.destroy', $shop));

        $this->assertDatabaseHas('shops', ['id' => $shop->id]);
        $response->assertRedirect(route('admin.login'));
    }

    public function test_user_cannot_access_admin_shops_destroy()
    {
        $user = User::factory()->create();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('admin.shops.destroy', $shop));

        $this->assertDatabaseHas('shops', ['id' => $shop->id]);
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_admin_shops_destroy()
    {
        $admin = new Admin();
        $admin->name = '管理者';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $category = new Category();
        $category->name = '和食';
        $category->save();

        $shop = Shop::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->delete(route('admin.shops.destroy', $shop));

        $this->assertDatabaseMissing('shops', ['id' => $shop->id]);
        $response->assertRedirect(route('admin.shops.index'));
    }
}
        

