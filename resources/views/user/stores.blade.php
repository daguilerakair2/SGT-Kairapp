@extends('layouts.navbar')

@section('title')
    Select Stores
@endsection

@section('content')
    @if ($user->storesUser->count() > 0)

        <div class="flex flex-col justify-center items-center relative">
            <div class="flex flex-col items-center bg-green-custom-500 w-5/6  sm:w-4/5 my-2 p-2 rounded-sm">
                <p class="text-lg text-white font-semibold text-center">Hola, {{ $user->name }}</p>
                <p class="text-lg text-white font-semibold text-center">¿A qué comercio quieres acceder?</p>
            </div>
            @foreach ($user->storesUser as $storeUser)
                <div class="my-2 w-4/5">
                    <a href="{{ route('store.index', ['id' => $storeUser->id]) }}"
                        class="flex flex-col items-center p-4 mx-auto bg-white border border-gray-200 transition-all rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img loading="lazy" class="w-40 h-40 rounded-t-lg sm:h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="https://alphakairappbucket.s3.sa-east-1.amazonaws.com/kairapp/icono-ingreso-administrador-01.svg" alt="store-icon">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $storeUser->storeInfo->fantasyName }}
                            </h5>
                            @if (!$storeUser->admin)
                            <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">
                                {{ $storeUser->subStoreUser->name }}
                            </p>
                            @endif
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $storeUser->roleUser->name }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col justify-center items-center">
            <div class="flex flex-col items-center bg-cyan-500 w-5/6  sm:w-4/5 my-2 p-2 rounded-sm">
                <p class="text-lg text-white font-semibold">Hola, {{ $user->name }}</p>
                <p class="text-lg text-white font-semibold">Aun no perteneces a ningun comercio.</p>
            </div>
        </div>
    @endif

@endsection
