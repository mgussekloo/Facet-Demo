<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Cache;

use App\Models\Product;
use Mgussekloo\Facades\FacetFilter;

class HomeController extends BaseController
{
	public function home()
	{
		$start = microtime(true);
		$filter = request()->all();

		$pagination = null;

		/* use the index (need to build one first) */
		// $products = Product::with(['sizes'])->facetFilter($filter)->paginate(20);
		$products = Product::with(['sizes'])->cacheTag('published')->facetFilter($filter)->paginate(20);
		$pagination = $products->appends(request()->input())->links();

		// /* or, if the dataset is small enough, use the collection filtering */
		// $products = Product::with(['sizes'])->get();
		// $products = $products->indexlessFacetFilter($filter, \App\MyCustomIndexer::class);

		$time_elapsed_secs = microtime(true) - $start;

		return view('welcome', [
			'products' => $products,
			'pagination' => $pagination,
			'time' => $time_elapsed_secs,
			'facets' => Product::getFacets()
		]);
	}
}
