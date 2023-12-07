<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Models\Product;

class HomeController extends BaseController
{
	public function home()
	{
		$filter = request()->all();

		$products = Product::facetsMatchFilter($filter)->get();
		$facets = Product::getFacets();

		return view('welcome', [
			'facets' => $facets,
			'filter' => $filter,
			'products' => $products
		]);
	}
}
