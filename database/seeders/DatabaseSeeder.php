<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User

        User::create([
            'name' => 'Kaungminkhant',
            'email'=> 'kmk@a.com',
            'password' => Hash::make('password'),
            'address' => 'address',
        ]);

        User::create([
            'name' => 'Admin',
            'email'=> 'admin@a.com',
            'password' => Hash::make('password'),
            'address' => 'address',
            'role' => 'admin',
        ]);

        Supplier::create([
            'name' => 'Supplier One',
            'image' => 'image.png',
        ]);

        // Brand

        $brands = ['Huawei','Samsung' ,'Apple','Xiaomi'];
        foreach($brands as $b){
            Brand::create([
                'slug' => Str::slug($b),
                'name' => $b,
            ]);
        }

        // Category
        $category = ['Phone', 'Cove' ,'Accessory','Smart Watch'];
        foreach($category as $c){
            Category::create([
                'slug' => Str::slug($c),
                'name' => $c,
            ]);
        }

        // Color 

        $color = ['Red', 'Green' ,'Blue'];
        foreach($color as $c){
            Color::create([
                'slug' => Str::slug($c),
                'name' => $c,
            ]);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
