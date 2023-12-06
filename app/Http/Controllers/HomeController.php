<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Models\Product;

class HomeController extends BaseController
{
	public function home()
	{
		$filter = Product::getFilterFromArr(request()->all());
		$products = Product::facetsMatchFilter($filter)->get();

		return view('welcome', [
			'facets' => Product::getFacets(),
			'filter' => $filter,
			'products' => $products
		]);
	}
}
