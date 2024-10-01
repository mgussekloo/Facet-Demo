<?php

namespace App;

class MyCustomIndexer extends \Mgussekloo\FacetFilter\Indexer {
	public function buildValues($facet, $model) {
		$values = parent::buildValues($facet, $model);

		if ($facet->title == 'Exclusivity') {

			if ($model->id % 3 == 0) {
				return collect('Not very');
			}
			if ($model->id % 11 == 0) {
				return collect('Mildly');
			}
			if ($model->id % 17 == 0) {
				return collect('Exclusive');
			}
		}

		return $values;
	}
}