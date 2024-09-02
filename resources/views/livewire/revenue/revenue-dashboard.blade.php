<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Revenue Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Daily Revenue -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Daily Revenue</h2>
            <p class="text-2xl font-bold">{{ number_format($dailyTotal, 2) }}</p>
        </div>

        <!-- Weekly Revenue -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Weekly Revenue</h2>
            <p class="text-2xl font-bold">{{ number_format($weeklyTotal, 2) }}</p>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Monthly Revenue</h2>
            <p class="text-2xl font-bold">{{ number_format($monthlyTotal, 2) }}</p>
        </div>
    </div>

    <!-- Revenue Charts -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Revenue Performance</h2>
        <div id="revenueChart"></div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: [{
                name: 'Revenue',
                data: [{{ $dailyTotal }}, {{ $weeklyTotal }}, {{ $monthlyTotal }}]
            }],
            chart: {
                type: 'line',
                height: 350
            },
            xaxis: {
                categories: ['Daily', 'Weekly', 'Monthly']
            }
        };

        var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    });
</script>
@endpush
