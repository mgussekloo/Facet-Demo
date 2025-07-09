<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
        	<div class="flex">
        		<div class="w-1/4 flex-none">
        			@foreach ($facets as $facet)
        				<p>
        					<h3>{{ $facet->title }}</h3>

        					@foreach ($facet->getOptions() as $option)
        						<a href="?{{ $option->http_query }}" class="{{ $option->selected ? 'underline' : '' }}">{{ $option->value }} ({{ $option->total }}) </a><br />
        					@endforeach
        				</p><br />
    				@endforeach
        		</div>
        		<div class="w-3/4">
        			<strong>Filtering took: {{ $time }} s.</strong><br /><br />
		            @foreach ($products as $product)
		            	<p>
		            		<h1>
		            			@if (!$product->published)<s>@endif
		            			{{ $product->name }}
		            			@if (!$product->published)</s>@endif
		            			({{ $product->sizes->isNotEmpty() ? $product->sizes->pluck('name')->join(', ') : 'n/a' }})
		            		</h1>
		            		€ {{ $product->price }}<br />
		            		{{ $product->color }}<br />
		            		<br />
		            	</p>
		            @endforeach

	        		{!! $pagination ?? '' !!}

		        </div>
		    </div>

        </div>
    </body>
</html>
