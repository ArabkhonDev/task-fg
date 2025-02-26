<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['tehnikalar', 'uy-anjoylari', 'moshinalar', 'ish', 'elektronika', 'moda-va-stil', 'bolalar-uchun', 'hobbi-sport', 'xayvonlar', 'yer-uchastkalari', 'almashtirish', 'tekinga-berib-yuborish'];
        foreach ($categories as $category) {
           Category::create([
               'name'=> $category
           ]);
        }
    }
}
