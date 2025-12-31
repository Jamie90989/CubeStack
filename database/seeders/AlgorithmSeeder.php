<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AlgorithmSeeder extends Seeder
{
    public function run(): void
    {
        $mainCategory = \App\Models\Category::create([
            'name' => '3x3',
            'category_level' => 1,
            'is_standard' => true,
        ]);

        $ollCategory = \App\Models\Category::create([
            'name' => 'OLL',
            'category_level' => 2,
            'parent_category_id' => $mainCategory->id,
            'is_standard' => true,
        ]);

        $pllCategory = \App\Models\Category::create([
            'name' => 'PLL',
            'category_level' => 2,
            'parent_category_id' => $mainCategory->id,
            'is_standard' => true,
        ]);

        $ollAlgorithms = json_decode(file_get_contents(database_path('seeders/ollAlgs.json')), true);
        foreach ($ollAlgorithms as $alg) {
            $alg['category_id'] = $ollCategory->id;
            \App\Models\Algorithm::create($alg);
        }

        $pllAlgorithms = json_decode(file_get_contents(database_path('seeders/pllAlgs.json')), true);
        foreach ($pllAlgorithms as $alg) {
            $alg['category_id'] = $pllCategory->id;
            \App\Models\Algorithm::create($alg);
        }
    }
}
