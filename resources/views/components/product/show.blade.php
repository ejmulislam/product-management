<div class="w-full flex gird grid-cols-2 gap-8">
	<div>
		<img src="{{ asset('uploads/'.$product->image) }}" alt="Product image" class="max-w-[500px]">
	</div>
	<div>
		<h1 class="text-2xl font-bold text-gray-700 mb-4">Title: {{ $product->name }} </h1>
		<div class="flex items-center gap-2 mb-2">
			<p class="text-lg text-gray-600 font-semibold">Product Id:</p>
			<span>{{ $product->product_id }}</span>
		</div>
		<div class="flex items-center gap-2 mb-2">
			<p class="text-lg text-gray-600 font-semibold">Description:</p>
			<span>{{ $product->description }}</span>
		</div>
		<div class="flex items-center gap-2 mb-2">
			<p class="text-lg text-gray-600 font-semibold">Price:</p>
			<span> ${{ $product->price }}</span>
		</div>
		<div class="flex items-center gap-2 mb-2">
			<p class="text-lg text-gray-600 font-semibold">Stock:</p>
			<span>{{ $product->stock }}</span>
		</div>

	</div>
</div>