<?php

namespace App;

class MyCustomIndexer extends \Mgussekloo\FacetFilter\Indexer {

	public function buildValues($facet, $model) {
		$values = parent::buildValues($facet, $model);

		if ($facet->fieldname == 'published') {
			$values = array_map(function($value) {
				return $value ? 'Yes' : 'No';
			}, $values);
		}

		if ($facet->fieldname == 'price') {

			if ($model->price > 1000) {
				return 'Expensive';
			}
			if ($model->price > 500) {
				return '500 - 1000';
			}
			if ($model->price > 250) {
				return '250 - 500';
			}
			return '0 - 250';
		}

		return $values;
	}

}