<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome Admin!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="rounded-lg shadow-md bg-white overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Manage Admin Accounts</h3>
                        <p class="text-gray-600">Click below to manage all accounts.</p>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 border-t border-gray-200">
                        <a href="{{ route('admin.create') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center py-2 px-4 rounded">Manage Accounts</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-lg shadow-md bg-white overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Manage Comments</h3>
                        <p class="text-gray-600">Click below to manage all comments made by users.</p>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 border-t border-gray-200">
                        <a href="{{ route('reviews.index') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center py-2 px-4 rounded">Manage Comments</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Placeholder for the pie chart -->
    <div class="flex justify-center">
        <div class="max-w-lg bg-white rounded-lg shadow-md p-4">
            <canvas id="accountPieChart"></canvas>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data for the pie chart
            var totalAccounts = {
                'Sellers': {{ $sellerCount }},
                'Admins': {{ $adminCount }},
                'Users': {{ $userCount }}
            };

            // Create pie chart
            var ctx = document.getElementById('accountPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(totalAccounts),
                    datasets: [{
                        label: 'Total Accounts',
                        data: Object.values(totalAccounts),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    // Add options here if needed
                }
            });
        });
    </script>
</x-app-layout>
