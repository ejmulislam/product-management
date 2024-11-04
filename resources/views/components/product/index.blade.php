@if (count($products) > 0)
<div class="flex items-center justify-between mb-6">
	<h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Products</h1>
	<a href="{{ url('/products/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Product</a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
	<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
		<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			<tr>
				<th scope="col" class="px-6 py-3">
					Id
				</th>
				<th scope="col" class="px-6 py-3">
					<a href="{{ route('products.index', ['sort' => 'name', 'order' => ($sortField == 'name' && $sortOrder == 'asc') ? 'desc' : 'asc']) }}">
						Name
						@if($sortField == 'name')
							@if($sortOrder == 'asc')
								&uarr; <!-- Up arrow for ascending -->
							@else
								&darr; <!-- Down arrow for descending -->
							@endif
						@endif
					</a>
				</th>
				<th scope="col" class="px-6 py-3">
					<a href="{{ route('products.index', ['sort' => 'price', 'order' => ($sortField == 'price' && $sortOrder == 'asc') ? 'desc' : 'asc']) }}">
						Price
						@if($sortField == 'price')
							@if($sortOrder == 'asc')
								&uarr;
							@else
								&darr;
							@endif
						@endif
					</a>
				</th>
				<th scope="col" class="px-6 py-3">
					Stock
				</th>
				<th scope="col" class="px-6 py-3">
					Image
				</th>
				<th scope="col" class="px-6 py-3 text-center">
					<span>Action</span>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $product)
				<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
					<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
						{{ $product->product_id }}
					</th>
					<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
						{{ $product->name }}
					</th>
					<td class="px-6 py-4">
						{{ $product->price }}
					</td>
					<td class="px-6 py-4">
						{{ $product->stock }}
					</td>
					<td class="px-6 py-4">
						<img src="{{ asset('uploads/'.$product->image) }}" alt="Product image" class="w-16 h-10">
					</td>
					<td class="px-6 py-4 text-center space-x-2 flex items-center justify-center">
						<a href="{{ url('/products/'.$product->id.'/edit') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
							@include('components.icons.edit')
						</a>
						<a href="{{ url('/products/'.$product->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
							@include('components.icons.show')
						</a>
						<form class="mt-1" action="{{ url('products', $product->id) }}" onclick="return confirm('Are you sure?')" method="POST">
							@csrf
							@method('DELETE')
							  <button type="submit" class="delete-button">
								 @include('components.icons.trash')
							  </button>
						 </form>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class="text-center">
		<p class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">I don't have any products!</p>
		<a href="{{ url('/products/create') }}"
			class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
		>
			Add Product
		</a>
	</div>
@endif 

<!-- resources/views/products/index.blade.php -->

{{-- <table>
    <thead>
        <t

            <!-- Price column with sorting links -->
            <th>
                
            </th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}
