<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun demo untuk 3 role (password semuanya: password)
        $admin  = User::factory()->create(['name' => 'Admin Toko',     'email' => 'admin@example.com',  'role' => 'admin']);
        $editor = User::factory()->create(['name' => 'Editor Toko',    'email' => 'editor@example.com', 'role' => 'editor']);
        $demo   = User::factory()->create(['name' => 'Pelanggan Demo', 'email' => 'user@example.com',   'role' => 'user']);

        // 2. Kategori
        foreach (array_keys(ProductFactory::CATALOG) as $name) {
            Category::create([
                'name'        => $name,
                'slug'        => Str::slug($name),
                'description' => "Koleksi $name pilihan terbaik.",
            ]);
        }

        // 3. 60 produk
        Product::factory(60)->create();

        // 4. Post: 5 milik admin, 5 milik editor (untuk uji PostPolicy)
        Post::factory(5)->create(['user_id' => $admin->id]);
        Post::factory(5)->create(['user_id' => $editor->id]);

        // 5. Pelanggan, alamat, order, review
        $customers = User::factory(9)->create()->push($demo);
        $products  = Product::all();

        foreach ($customers as $customer) {
            $address = $customer->addresses()->create([
                'label'       => 'Rumah',
                'recipient'   => $customer->name,
                'phone'       => fake()->phoneNumber(),
                'street'      => fake()->streetAddress(),
                'city'        => 'Medan',
                'postal_code' => fake()->numerify('20###'),
                'is_default'  => true,
            ]);

            for ($i = 0; $i < 2; $i++) {
                $order = Order::create([
                    'user_id'      => $customer->id,
                    'address_id'   => $address->id,
                    'order_number' => 'INV-' . strtoupper(Str::random(8)),
                    'status'       => fake()->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']),
                    'total'        => 0,
                ]);

                $total = 0;
                foreach ($products->random(rand(1, 4)) as $product) {
                    $qty = rand(1, 3);
                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'unit_price' => $product->price,
                    ]);
                    $total += $qty * $product->price;
                }
                $order->update(['total' => $total]);
            }

            foreach ($products->random(3) as $product) {
                Review::create([
                    'user_id'    => $customer->id,
                    'product_id' => $product->id,
                    'rating'     => rand(3, 5),
                    'comment'    => fake()->sentence(8),
                ]);
            }
        }
    }
}
