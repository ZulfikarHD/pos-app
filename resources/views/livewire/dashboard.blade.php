<div class="container mx-auto p-6">
	<h1 class="mb-8 text-3xl font-bold text-gray-800">Dashboard</h1>

	<!-- Key Metrics Overview -->
	<div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
		<div class="rounded-lg bg-white p-6 shadow-lg transition-transform transform hover:scale-105">
			<h2 class="text-xl font-semibold text-gray-700">Total Sales</h2>
			<p class="text-3xl font-extrabold text-blue-600">{{ number_format($totalSales, 2) }}</p>
		</div>
		<div class="rounded-lg bg-white p-6 shadow-lg transition-transform transform hover:scale-105">
			<h2 class="text-xl font-semibold text-gray-700">Active Orders</h2>
			<p class="text-3xl font-extrabold text-blue-600">{{ $activeOrders }}</p>
		</div>
		<div class="rounded-lg bg-white p-6 shadow-lg transition-transform transform hover:scale-105">
			<h2 class="text-xl font-semibold text-gray-700">Customer Satisfaction</h2>
			<p class="text-3xl font-extrabold text-blue-600">{{ number_format($customerSatisfaction, 2) }}%</p>
		</div>
	</div>

	<!-- Sales Summary -->
	<div class="mb-8 rounded-lg bg-white p-6 shadow-lg">
		<h2 class="mb-4 text-xl font-semibold text-gray-700">Sales Summary</h2>
		<div id="salesSummaryChart"></div>
	</div>

	<!-- Inventory Alerts -->
	<div class="mb-8 rounded-lg bg-white p-6 shadow-lg">
		<h2 class="mb-4 text-xl font-semibold text-gray-700">Inventory Alerts</h2>
		@if ($lowStockProducts->isEmpty())
			<p class="text-green-600">All products are sufficiently stocked.</p>
		@else
			<ul class="list-disc pl-5">
				@foreach ($lowStockProducts as $product)
					<li class="text-gray-600">{{ $product->name }}: <span class="font-bold">{{ $product->stock_quantity }}</span> in stock</li>
				@endforeach
			</ul>
		@endif
	</div>

	<!-- Recent Activities -->
	<div class="rounded-lg bg-white p-6 shadow-lg">
		<h2 class="mb-4 text-xl font-semibold text-gray-700">Recent Activities</h2>
		@if ($recentActivities->isEmpty())
			<p class="text-gray-600">No recent activities.</p>
		@else
			<ul class="list-disc pl-5">
				@foreach ($recentActivities as $activity)
					<li class="text-gray-600">{{ $activity->created_at->format('Y-m-d H:i:s') }} - {{ $activity->description }}</li>
				@endforeach
			</ul>
		@endif
	</div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
			const salesSummaryChart = new ApexCharts(document.querySelector("#salesSummaryChart"), {
				chart: {
					type: 'line',
					toolbar: { show: false },
					zoom: { enabled: false }
				},
				series: [{
					name: 'Sales',
					data: @json(array_values($salesSummary))
				}],
				xaxis: {
					categories: ['Daily', 'Weekly', 'Monthly'],
					labels: {
						style: {
							colors: '#6B7280',
							fontSize: '14px'
						}
					}
				},
				tooltip: {
					theme: 'dark'
				}
			});
			salesSummaryChart.render();
		});
	</script>
@endpush
