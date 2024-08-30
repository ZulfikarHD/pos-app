<x-app-layout>
    <div class="dashboard-container">
        <!-- Header -->
        <header class="flex items-center justify-between p-4 bg-white shadow">
            <div class="logo">
                <h1 class="text-xl font-bold">POS Dashboard</h1>
            </div>
            <div class="search-bar flex-grow mx-4">
                <input type="text" placeholder="Search..." class="w-full px-4 py-2 border rounded">
            </div>
            <div class="user-profile">
                <x-profile-dropdown />
            </div>
        </header>

        <!-- Main Content Area -->
        <div class="p-6">
            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <x-key-metric-card title="Total Sales" value="$5,420" icon="dollar-sign" color="green" />
                <x-key-metric-card title="Active Orders" value="12" icon="shopping-cart" color="blue" />
                <x-key-metric-card title="Customer Satisfaction" value="89%" icon="smile" color="yellow" />
            </div>

            <!-- Sales Summary Chart -->
            <div class="bg-white p-6 rounded shadow mb-6">
                <h2 class="text-lg font-semibold mb-4">Sales Summary</h2>
                <livewire:sales-summary-chart />
            </div>

            <!-- Inventory Alerts -->
            <div class="bg-white p-6 rounded shadow mb-6">
                <h2 class="text-lg font-semibold mb-4">Inventory Alerts</h2>
                <livewire:inventory-alerts />
            </div>

            <!-- Recent Activities -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-4">Recent Activities</h2>
                <livewire:recent-activities />
            </div>
        </div>
    </div>
</x-app-layout>
