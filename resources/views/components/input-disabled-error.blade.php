@if (session('message'))
    {{-- <div class="bg-red-400 text-center my-2">
        <p class=" text-red-800 p-4"></p>{{ session('message') }}
    </div> --}}
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
            <li>{{ session('message') }}</li>
    </ul>
@endif
