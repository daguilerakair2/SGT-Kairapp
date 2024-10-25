<div>
    <div>
        <label for="subStores" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Sucursal
        </label>
        <select id="subStores" wire:model='selectedOption' wire:change='handleSelectChange'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($subStores as $subStore)
                <option value="{{ $subStore->id }}" data-sub-store-id="{{ $subStore->id }}">{{ $subStore->name }}</option>
            @endforeach
        </select>
    </div>

    @if ($selectedSubStore->schedulesSubstore()->get()->count() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-8">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-1/4 bg-gray-300 dark:bg-gray-800">
                            Días
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-300 dark:bg-gray-800">
                            Jornada Mañana
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-300 dark:bg-gray-800">
                            Jornada Tarde
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p>{{ $schedule->day_name }}</p>
                            </th>
                            <td class="px-6 py-4">
                                {{ $schedule->opening }} - {{ $schedule->closing }}
                            </td>
                            <td class="px-6 py-4">
                                {{ ($schedule->opening_optional && $schedule->closing_optional) ? $schedule->opening_optional . ' - ' . $schedule->closing_optional : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex justify-center my-12 w-full h-full">
            <a href="{{ route('schedule.create', ['subStore' => $selectedOption]) }}"
                class="w-1/2 text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Asignar horario
            </a>
        </div>
    @endif
</div>
