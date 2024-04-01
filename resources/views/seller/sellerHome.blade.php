<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome Seller!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="rounded-lg shadow-md bg-white overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Create/Manage a Product</h3>
                        <p class="text-gray-600">Click below to manage all products.</p>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 border-t border-gray-200">
                        <a href="{{ route('seller.createProduct') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center py-2 px-4 rounded">Manage Accounts</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-lg shadow-md bg-white overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Confirm Unpaid orders</h3>
                        <p class="text-gray-600">Click below to manage all unpaid orders.</p>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 border-t border-gray-200">
                        <!-- Inserting the link to the orders.showAndUpdate route -->
                        <a href="{{ route('order.edit', ['productId' => $productId]) }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center py-2 px-4 rounded">Confirm Unpaid Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data from the backend to populate the chart
            var totalUsersBought = {{ $totalUsersBought ?? 0 }};
            
            // Create a line chart
            var ctx = document.getElementById('userLineChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Users Who Bought'],
                    datasets: [{
                        label: 'Total Users',
                        data: [totalUsersBought],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    // Add options here if needed
                }
            });
        });
    </script>
    
    <!-- Placeholder for the line chart -->
    <div class="mt-6 flex justify-center">
        <div class="bg-white rounded-lg shadow-md p-4" style="width: 100%; max-width: 800px;">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Total Users Who Bought Your Products</h3>
            <canvas id="userLineChart" width="800" height="400"></canvas>
        </div>
    </div>
</x-app-layout>
