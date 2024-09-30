<?php

namespace App;

class MyCustomIndexer extends \Mgussekloo\FacetFilter\Indexer {
	public function buildValues($facet, $model) {
		$values = parent::buildValues($facet, $model);

		if ($facet->getSlug() == 'App\Models\Product.price') {
			foreach ($values as $index => $value) {
				if ($value > 0 && $value < 500) {
					$values[$index] = '0-490';
				}
				if ($value > 490 && $value < 1000) {
					$values[$index] = '500-990';
				}
				if ($value > 990) {
					$values[$index] = 'Expensive';
				}
			}
		}

		return $values;
	}
}