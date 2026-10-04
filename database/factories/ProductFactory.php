<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public const CATALOG = [
        'Fashion Pria'          => ['Kaos Oversize', 'Kemeja Flannel', 'Jaket Bomber', 'Celana Chino', 'Sepatu Sneakers'],
        'Fashion Wanita'        => ['Blouse Katun', 'Rok Plisket', 'Hijab Voal', 'Dress Casual', 'Tas Selempang'],
        'Elektronik'            => ['Headphone Bluetooth', 'Speaker Portable', 'Smartwatch', 'Webcam Full HD', 'Power Bank 20000mAh'],
        'Aksesoris Komputer'    => ['Keyboard Mekanik', 'Mouse Wireless', 'Mousepad Gaming', 'Hub USB-C', 'Stand Laptop'],
        'Perlengkapan Olahraga' => ['Botol Minum', 'Matras Yoga', 'Kacamata Renang', 'Raket Badminton', 'Sepatu Lari'],
        'Peralatan Rumah'       => ['Lampu Meja LED', 'Set Panci', 'Rak Serbaguna', 'Teko Listrik', 'Kipas Angin Mini'],
    ];

    public function definition(): array
    {
        $categoryName = fake()->randomElement(array_keys(self::CATALOG));
        $type  = fake()->randomElement(self::CATALOG[$categoryName]);
        $model = fake()->randomElement(['Premium', 'Classic', 'Slim', 'Sport', 'Minimalis', 'Pro', 'Eco']);
        $brand = fake()->randomElement(['Nusantara', 'Borneo', 'Sumatra', 'Prima', 'Kreasi', 'Bintang', 'Mahakarya']);
        $name  = "$type $model $brand";

        return [
            'category_id' => Category::where('name', $categoryName)->value('id'),
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 99999),
            'description' => fake()->paragraph(3),
            'price'       => fake()->numberBetween(25, 1500) * 1000,
            'stock'       => fake()->numberBetween(0, 200),
            'is_active'   => fake()->boolean(90),
        ];
    }
}
