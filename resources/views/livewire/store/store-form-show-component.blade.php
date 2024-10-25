<div class="my-36 sm:my-0">

    @if (!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    {{-- Store Form --}}
    <div class="bg-gray-100 p-4 rounded-sm shadow-[0px_3px_10px_0px_#2d3748]" wire:ignore.self>
        <h3 class="font-bold mb-4 text-xl uppercase text-black">Información tienda</h3>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <label for="rut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    RUT
                </label>
                <input wire:model="rut" type="text" name="rut" id="rut"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required />
                @error('rut')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
                @if (session()->has('message'))
                    <p class="text-sm text-red-500 font-semibold">{{ session('message') }}</p>
                @endif
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="checkDigit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Dígito verificador
                </label>
                <input wire:model="checkDigit" type="text" name="checkDigit" id="checkDigit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/6 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="K" required />
                @error('checkDigit')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid sm:grid-cols-2 sm:gap-4">
            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nombre Compañia
                </label>
                <input wire:model="companyName" type="text" name="floating_company_name" id="floating_company_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
                @error('companyName')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_fantasy_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nombre Fantasía
                </label>
                <input wire:model="fantasyName" type="text" name="floating_fantasy_name" id="floating_fantasy_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
                @error('fantasyName')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Radio --}}
        <div class="flex gap-2 items-center mb-4">
            <h3 class="font-semibold text-gray-900 dark:text-white">¿La tienda es itinerante?</h3>
            <button data-tooltip-target="tooltip-right" data-tooltip-placement="right" type="button"
                class=" text-white bg-transparent ">
                <svg class="w-7 h-7 text-blue-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>

            <div id="tooltip-right" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-xs sm:text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <p>Tienda itinerante se refiere a que puede no tener una ubicación fija.</p>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2">
                    <input checked id="check-radio" type="radio" wire:model='radioCheckedItinerant' value="Y"
                        name="default-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Si
                    </label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="no-check-radio" type="radio" wire:model='radioCheckedItinerant' value="N"
                        name="default-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        No
                    </label>
                </div>
            </div>
        </div>

        {{-- Radio --}}
        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">¿La tienda vende productos personalizados?</h3>
        <div class="mb-4">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2">
                    <input checked id="check-radio-custom" type="radio" wire:model='radioCheckedCustom' value="Y"
                        name="default-radio-custom"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-custom-1"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Si
                    </label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="no-check-radio-custom" type="radio" wire:model='radioCheckedCustom' value="N"
                        name="default-radio-custom"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-custom-2"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        No
                    </label>
                </div>
            </div>
        </div>

        {{-- Administrator Info --}}
        <h3 class="font-bold mb-4 text-xl uppercase text-black">Información administrador de la tienda</h3>
        <div class="grid sm:grid-cols-2 sm:gap-4">
            <div class="relative z-0 w-full mb-6 group">
                <label for="nameAdmin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nombre administrador
                </label>
                <input wire:model="nameAdmin" type="text" name="nameAdmin" id="nameAdmin"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required />
                @error('nameAdmin')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Correo electrónico
                </label>
                <input wire:model="email" type="text" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required />
                @error('email')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="my-8">
        <button wire:click="returnStoresManagement"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            type="button">
            Volver</button>
        <button
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
            wire:click="addStore" type="button">Crear Tienda</button>
    </div>
</div>
