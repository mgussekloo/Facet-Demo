<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Models\Product;
use App\MyCustomIndexer as Indexer;

class HomeController extends BaseController
{
	public function home()
	{

		$start = microtime(true);

		$filter = request()->all();

		// use the index (need to build one first)
		$products = Product::facetFilter($filter)->simplePaginate(15);

		// or, if the dataset is small enough, use the collection filtering
		// $indexer = new Indexer();
		// $products = Product::all()->indexlessFacetFilter($filter, $indexer);

		$facets = Product::getFacets();

		$time_elapsed_secs = microtime(true) - $start;

		return view('welcome', [
			'facets' => $facets,
			'filter' => $filter,
			'products' => $products,
			'time' => $time_elapsed_secs
		]);
	}
}
