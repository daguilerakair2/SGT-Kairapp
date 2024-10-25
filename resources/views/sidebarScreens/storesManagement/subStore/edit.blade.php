<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar tiendas') }}
        </h2>
    </x-slot>

    <div class="fixed z-10 sm:relative sm:z-0 p-6 w-full bg-gray-custom-600">
        <h1 class="ml-8 sm:ml-0 font-bold text-white text-2xl sm:text-3xl">Administrar tiendas - Editar Sucursal</h1>
    </div>

    <div class="h-full p-4 ">
            @livewire('subStore.edit-sub-store-show', ['subStore' => $subStore])
    </div>
</x-app-layout>