<div class="px-4 pt-6">
    <div class="grid grid-cols-3 gap-4 mt-4">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-6">
                {{-- BARCHART HERE --}}
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-6">
                {{-- PIECHART HERE --}}
                <canvas id="pieChart" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-6 items-center">
                {{-- LINECHART HERE --}}
                <canvas id="lineChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>