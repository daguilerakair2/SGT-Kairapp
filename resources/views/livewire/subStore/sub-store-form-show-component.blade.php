<div class="my-32 sm:my-0">
    @if (session()->has('password'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Administrador de tienda creado con éxito</span>
            Recuerde suministrar su contraseña al administrador creado.
            <button id="btn">
                Mostrar contraseña
            </button>
            <input type="hidden" id="password" name="password" value="{{ session('password') }}">
        </div>
    @endif
    {{-- SubStore Form --}}
    <div class="bg-gray-100 p-4 rounded-sm shadow-[0px_3px_10px_0px_#2d3748]" wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre Sucursal
            </label>
            <input wire:model="name" type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Dirección
            </label>
            <input wire:model="address" type="text" name="address" id="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('address')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-6 group">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Seleccione su Ciudad
            </label>

            {{-- Select Country --}}
            <div class="flex flex-row gap-4">
                <div class="flex flex-row items-center gap-2 w-1/2">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        País
                    </label>
                    <select id="$countries" wire:model='selectedCountry' wire:change="handleSelectCountry($event.target.value)"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>--Seleccione--</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Select State --}}
                <div class="flex flex-row items-center gap-2 w-1/2">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Estado
                    </label>
                    <select id="states" wire:model='selectedState' wire:change="handleSelectState($event.target.value)"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>--Seleccione--</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Select City --}}
            <div class="flex flex-row items-center gap-2 mt-8">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Ciudad
                </label>
                <select id="cities" wire:model='selectedCity'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        <input wire:model="latitude" type="hidden" name="latitude" id="latitude" />
        <input wire:model="longitude" type="hidden" name="longitude" id="longitude" />

        <div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Teléfono
                </label>
                <input wire:model="phone" type="tel" name="phone" id="phone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" />
                @error('phone')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="commission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Comisión
                </label>
                <input wire:model="commission" type="number" min="0.00001" name="commission" id="commission"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" />
                @error('commission')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>


            {{-- <label for="commission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Horario Sucursal
            </label> --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/4 bg-gray-300 dark:bg-gray-800">
                                Días
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-300 dark:bg-gray-800">
                                Jornada
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $key => $schedule)
                            <tr wire:key='{{ $key }}' class="border-b border-gray-200 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    {{-- Lunes --}}
                                    <div class="flex flex-row gap-4">
                                        @foreach ($schedule['days'] as $day)
                                            <div class="flex flex-col items-center">
                                                <label for="default-checkbox"
                                                    class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ $day }}
                                                </label>
                                                <input
                                                    wire:model="schedules.{{ $key }}.selectDays.{{ $day }}"
                                                    id="{{ $key }}-{{ $day }}-checkbox" checked
                                                    type="checkbox" value="{{ $day }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        @endforeach
                                    </div>
                                </th>
                                <td class="px-6 py-4 bg-gray-100 dark:text-white dark:bg-gray-400">
                                    <div class="flex flex-row justify-center items-center w-full">
                                        <div class="flex flex-col w-full md:w-1/6 items-center mr-8">
                                            <button type="button"
                                                wire:click="viewHiddenInformation('{{ $key }}')"
                                                class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 transition-all focus:ring-4 focus:ring-purple-300 font-medium rounded-lg md:text-sm px-8 md:px-5 py-1 md:py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                                Jornada Continua
                                            </button>
                                            <button type="button"
                                                wire:click="viewHiddenInformation('{{ $key }}')"
                                                class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 transition-all focus:ring-4 focus:ring-purple-300 font-medium rounded-lg md:text-sm px-8 md:px-5 py-1 md:py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                                Jornada Dividida
                                            </button>
                                        </div>

                                        <div class="flex flex-col gap-4 w-1/2">
                                            <div class="flex items-center justify-center">
                                                <div class="relative">
                                                    <select id="subStores"
                                                        wire:model="schedules.{{ $key }}.opening"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        {{-- @foreach ($subStores as $subStore) --}}
                                                        <option value="08:00" selected>08:00</option>
                                                        <option value="08:30">08:30</option>
                                                        <option value="09:00">09:00</option>
                                                        <option value="09:30">09:30</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="10:30">10:30</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="11:30">11:30</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="12:30">12:30</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="13:30">13:30</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="14:30">14:30</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="15:30">15:30</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="16:30">16:30</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="17:30">17:30</option>
                                                        <option value="18:00">18:00</option>
                                                        <option value="18:30">18:30</option>
                                                        <option value="19:00">19:00</option>
                                                        <option value="19:30">19:30</option>
                                                        <option value="20:00">20:00</option>
                                                        <option value="20:30">20:30</option>
                                                        <option value="21:00">21:00</option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                </div>
                                                <span class="mx-4 text-gray-500">hasta</span>
                                                <div class="relative">
                                                    <select id="subStores"
                                                        wire:model="schedules.{{ $key }}.closing"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        {{-- @foreach ($subStores as $subStore) --}}
                                                        <option value="08:00">08:00</option>
                                                        <option value="08:30">08:30</option>
                                                        <option value="09:00">09:00</option>
                                                        <option value="09:30">09:30</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="10:30">10:30</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="11:30">11:30</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="12:30">12:30</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="13:30">13:30</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="14:30">14:30</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="15:30">15:30</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="16:30">16:30</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="17:30">17:30</option>
                                                        <option value="18:00">18:00</option>
                                                        <option value="18:30">18:30</option>
                                                        <option value="19:00">19:00</option>
                                                        <option value="19:30">19:30</option>
                                                        <option value="20:00">20:00</option>
                                                        <option value="20:30">20:30</option>
                                                        <option value="21:00" selected>21:00</option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($schedule['viewOptionalSchedules'])
                                                <div class="flex justify-center items-center">
                                                    <div class="relative">
                                                        <select id="subStores"
                                                            wire:model="schedules.{{ $key }}.openingOptional"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            {{-- @foreach ($subStores as $subStore) --}}
                                                            <option value="08:00" selected>08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="13:30">13:30</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="14:30">14:30</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="15:30">15:30</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="16:30">16:30</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="17:30">17:30</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="18:30">18:30</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="19:30">19:30</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="20:30">20:30</option>
                                                            <option value="21:00">21:00</option>
                                                            {{-- @endforeach --}}
                                                        </select>
                                                    </div>
                                                    <span class="mx-4 text-gray-500">hasta</span>
                                                    <div class="relative">
                                                        <select id="subStores"
                                                            wire:model="schedules.{{ $key }}.closingOptional"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            {{-- @foreach ($subStores as $subStore) --}}
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="13:30">13:30</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="14:30">14:30</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="15:30">15:30</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="16:30">16:30</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="17:30">17:30</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="18:30">18:30</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="19:30">19:30</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="20:30">20:30</option>
                                                            <option value="21:00" selected>21:00</option>
                                                            {{-- @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="md:mx-auto my-auto w-1/4">
                                            <button type="button"
                                                wire:click="removeShieldSchedule('{{ $key }}')">
                                                <svg class="w-7 h-7 ml-8 sm:ml-12 text-gray-500 hover:text-gray-800 transition-all cursor-pointer dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </button>
                                            @if ($loop->last)
                                                <div class="ml-8 sm:ml-9 my-8">
                                                    <a wire:click='addShieldSchedule'
                                                        class="cursor-pointer text-white bg-green-500 hover:bg-green-700 transition-all focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-2 sm:px-5 py-2.5 text-center mr-2 mb-2">
                                                        Añadir
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <p>{{ $key }}</p> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (session()->has('scheduleMessage'))
                <p class="text-md text-red-500 font-bold">{{ session('scheduleMessage') }}</p>
            @endif
        </div>

        <div class="mt-8" wire:loading.remove wire:target="addSubStore">
            <button wire:click="returnStoresManagement"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                type="button">
                Volver</button>
            <button wire:loading.attr="disabled" @if ($disabledButton) disabled @endif
                class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                type="button" wire:click="addSubStore">
                Crear Sucursal
            </button>
        </div>
        <div class="flex justify-center">
            <div wire:loading wire:target="addSubStore" class="text-center">
                <div role="status">
                    <svg aria-hidden="true"
                        class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-pink-custom-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script async defer {{-- src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initialize" --}} src="{{ route('load-google-maps-script') }}" type="text/javascript">
    </script>

    <script type="text/javascript">
        function initialize() {
            let input = document.getElementById('address');
            let autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                let place = autocomplete.getPlace();
                console.log(place.formatted_address);
                @this.set('address', place.formatted_address);
                @this.set('latitude', place.geometry.location.lat());
                @this.set('longitude', place.geometry.location.lng());
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.getElementById('password').value;
            if (password) {
                Swal.fire({
                    title: 'Recuerda copiar la contraseña de tu administrador',
                    text: password,
                    icon: 'info',
                    confirmButtonColor: '#FF5C77',
                    confirmButtonText: 'Cancelar',
                })
            }
        });
    </script>

    <script>
        const button = document.getElementById('btn');
        if (button) {
            button.addEventListener('click', () => {
                const password = document.getElementById('password').value;
                console.log(password);
                Swal.fire({
                    title: 'Recuerda copiar la contraseña de tu administrador',
                    text: password,
                    icon: 'info',
                    confirmButtonColor: '#FF5C77',
                    confirmButtonText: 'Cancelar',
                })
            });
        }
    </script>
@endpush
