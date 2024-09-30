<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\MyCustomIndexer as Indexer;
use App\Models\Product;

class BuildIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build Facet index';

    /**
     * Execute the console command.
     */
    public function handle()
    {
		$products = Product::with(['sizes'])->get(); // get some products

		$indexer = new Indexer();
		$indexer->resetIndex(); // clears the index
		$indexer->buildIndex($products); // process the models
    }
}
