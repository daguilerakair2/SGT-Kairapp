<div>
    <div class="relative">
        <img
            {{-- style="background-image: url('{{ asset('/images/fondos-regalos-gris.svg') }}');" --}}
            class="sm:h-48 lg:h-56 w-full lg:mx-auto bg-white"
            src="{{ session('store')->pathBackground }}"
            loading="lazy"
            alt="background-image" />
        <img class="rounded-full shadow-xl dark:shadow-gray-800 absolute top-20 sm:top-36 lg:top-40 left-4 w-24 h-24 sm:w-36 sm:h-36 lg:w-48 lg:h-48 bg-white"
            src="{{ session('store')->pathProfile }}" loading="lazy" alt="image description" />

        <div class="flex justify-between items-center">
            <h1 class="ml-32 sm:ml-44 lg:ml-64 mt-8 font-bold text-black text-2xl sm:text-3xl">
                {{ session('store')->fantasyName }}</h1>

            {{-- <div class="mr-8 mt-8">
                <button
                    wire:click="$dispatch('openModal', {component: 'profile.store.edit-profile', arguments: {store_id: {{ session('store')->rut }}}})"
                    class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                >
                Editar Perfil
                </button>
            </div> --}}
        </div>
    </div>
</div>
