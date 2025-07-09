<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Size;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

	    Product::factory()->count(10000)
	    ->sequence(function($sequence) {
	    	return [
				'name' => implode(' ', fake()->words(2)),
            	'color' => fake()->safeColorName(),
            	'published' => fake()->boolean()
	    	];
	    })
	    ->afterCreating(function($product) {
	    	$count = random_int(0, 3);
	    	$sizes = collect(['small', 'medium', 'large', 'extralarge'])->random($count);

	    	Size::factory($count)
	    	->sequence(function($sequence) use ($sizes) {
	    		return [
	    			'name' => $sizes[$sequence->index]
	    		];
	    	})
	    	->for($product)
	    	->create();
	    })
	    ->create();

    }
}
