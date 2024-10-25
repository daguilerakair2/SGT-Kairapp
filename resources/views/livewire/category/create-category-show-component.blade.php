<div class="mt-36 sm:mt-0 bg-gray-100 p-4 rounded-sm shadow-[0px_3px_10px_0px_#2d3748]">
    <div class="lds-hourglass"></div>
    <div wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre categoría
            </label>
            <input type="name" wire:model='name' id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required>
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <a class="block text-sm font-medium text-gray-900 dark:text-white">
            Nombre característica
        </a>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach ($characteristics as $key => $characteristic)
                <div class="mb-4 flex">

                    <div class="relative w-full" wire:key="{{ $key }}">
                        <input
                            class="bg-gray-50 border border-gray-300 my-4 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" wire:model="characteristics.{{ $key }}.name"
                            name="shield_{{ $key }}" />
                        <button
                            class="bg-red-500 absolute rounded-r-lg right-0 top-0 end-0 p-2.5 h-auto my-4 text-white"
                            wire:click="removeShield('{{ $key }}')">
                            Eliminar
                        </button>
                        @error("characteristics.$key.name")
                            <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                        @if (session()->has('categoryMessage'))
                            <p class="text-sm text-red-500 font-semibold">{{ session('categoryMessage') }}</p>
                        @endif
                    </div>
                    @if ($loop->last)
                        <button wire:click="addShield"
                            class="bg-green-600 rounded-lg py-2.5 px-4  ml-2 my-4 text-white text-sm font-bold">+</button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex gap-2 justify-center">
        <button wire:click='save'
            class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Agregar Categoria
        </button>
        <button wire:click="returnInventory"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
</div>
