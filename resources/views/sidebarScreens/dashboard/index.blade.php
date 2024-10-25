<x-app-layout>
    @push('chart')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="fixed z-10 sm:relative sm:z-0 p-6 w-full bg-gray-custom-600">
        <div class="flex flex-col sm:flex-row sm:items-start gap-2">
            <h1 class="ml-8 sm:ml-0 font-bold text-white text-2xl sm:text-3xl">Dashboard -</h1>
            <h1 class="ml-8 sm:ml-0 font-bold text-white text-2xl sm:text-3xl">{{ session('store')->fantasyName }}</h1>
        </div>
    </div>

    <div class="h-full p-4 ">
        @livewire('dashboard.dashboard-show-component')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</x-app-layout>
