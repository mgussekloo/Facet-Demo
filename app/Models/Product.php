<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mgussekloo\FacetFilter\Traits\Facettable;

use App\MyCustomIndexer;

class Product extends Model
{
    use HasFactory;
    use Facettable;

	public static function facetDefinitions()
	{
		// Return an array of definitions
		return [
			// [
			// 	'title' => 'Published',
			// 	'fieldname' => 'published'
			// ],
			[
				'title' => 'Main color', // The title will be used for the parameter.
				'fieldname' => 'color' // Model property from which to get the values.
			],
			[
				'title' => 'Sizes',
				'fieldname' => 'sizes.name' // Use dot notation to get the value from related models.
			],
			[
				'title' => 'Price',
				'fieldname' => 'price'
			]
		];
	}

	public static function indexer()
	{
		return new MyCustomIndexer();
	}

    public function sizes()
    {
    	return $this->hasMany(Size::class);
    }

    public function getPriceAttribute()
    {
    	return $this->id * 5;
    }
}
