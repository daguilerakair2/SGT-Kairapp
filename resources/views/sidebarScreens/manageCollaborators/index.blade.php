<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar colaboradores') }}
        </h2>
    </x-slot>

    <div class="fixed z-10 sm:relative sm:z-0 p-6 w-full bg-gray-custom-600">
        <div class="flex flex-col sm:flex-row sm:items-start sm:gap-2">
            <h1 class="ml-8 sm:ml-0 font-bold text-white text-xl sm:text-3xl">Administrar colaboradores -</h1>
            <h3 class="ml-8 sm:ml-0 font-bold text-white text-lg sm:text-3xl">{{ session('role')->name }} </h3>
        </div>
    </div>

    <div class="h-full p-4 ">
        @livewire('collaborator.collaborator-show')
    </div>
</x-app-layout>
