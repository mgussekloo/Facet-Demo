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

		$pagination = null;

		// use the index (need to build one first)
		$products = Product::with(['sizes'])->facetFilter($filter)->simplePaginate(15);
		$pagination = $products->appends(request()->input())->links();

		// or, if the dataset is small enough, use the collection filtering
		// $indexer = new Indexer();
		// $products = Product::with(['sizes'])->get()->indexlessFacetFilter($filter, $indexer);

		$facets = Product::getFacets();

		$time_elapsed_secs = microtime(true) - $start;

		return view('welcome', [
			'facets' => $facets,
			'filter' => $filter,
			'products' => $products,
			'pagination' => $pagination,
			'time' => $time_elapsed_secs
		]);
	}
}
