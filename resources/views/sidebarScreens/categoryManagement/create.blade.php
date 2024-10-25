<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestor de Inventario') }}
        </h2>
    </x-slot>

    <div class="fixed z-10 sm:relative sm:z-0 p-6 w-full bg-gray-custom-600">
        <div class="flex flex-col sm:flex-row sm:items-start sm:gap-2">
            <h1 class="ml-8 sm:ml-0 font-bold text-white text-2xl sm:text-3xl">Gestor de Inventario -
                {{ session('store')->fantasyName }}</h1>
            <h3 class="ml-8 sm:ml-0 font-bold text-white text-lg sm:text-xl">{{ session('role')->name }} </h3>
        </div>
    </div>

    <div class="h-full p-4 ">
        @livewire('category.create-category-show-component')
    </div>
</x-app-layout>
