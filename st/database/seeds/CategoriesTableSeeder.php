<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Smart Phones","Smart Tvs", "Games"];
        for ( $i =0 ; $i < 3 ; $i++)
        {
            DB::table('categories')->insert([
                'name' => $categories[$i],
            ]);
        }
    }
}
