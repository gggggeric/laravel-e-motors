<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome User!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Search Form -->
                    <form action="{{ route('seller.searchProducts') }}" method="GET" class="mb-4 flex justify-end">
                        <div class="flex">
                            <input type="text" name="query" class="form-input rounded-l-md" placeholder="Search...">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md">Search</button>
                        </div>
                    </form>

                    <div class="flex flex-wrap justify-between">
                        @foreach($products as $product)
                            @if($product->quantity > 0)
                            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 mb-4 mr-4">
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                    <div class="p-4" style="position: relative; height: 200px; overflow: hidden;">
                                        <div style="background-image: url('{{ asset('storage/' . $product->product_image) }}'); background-size: cover; background-position: top; width: 100%; height: 100%;"></div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-lg">{{ $product->product_name }}</h3>
                                        <p class="text-gray-600">Type: {{ $product->product_type }}</p>
                                        <p class="text-gray-600">Amount: ₱{{ $product->amount }}</p>
                                        <p class="text-gray-600">Stocks: {{ $product->quantity }}</p>
                                        <p>------------------------------------- </p>
                                        <!-- Modified button with form for GET request -->
                                        <form method="get" action="{{ route('order.create', ['product_id' => $product->id]) }}">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Order Now
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
