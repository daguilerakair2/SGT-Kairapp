<div class="my-24 sm:my-0 bg-gray-100 p-4 rounded-sm shadow-[0px_3px_10px_0px_#2d3748] sm:w-1/2 mx-auto">
    <div wire:ignore.self>
        <div class="relative z-0 w-full mb-6 group">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Titulo
            </label>
            <input wire:model="title" type="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
            @error('title')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Teléfono
            </label>
            <input wire:model="phone" type="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
            @error('phone')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Mensaje
            </label>
            <textarea wire:model="message" name="message" id="message" rows="8" maxlength="500"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 resize-none rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Describe tu inquietud..."></textarea>
            <p class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Carácteres: <span
                    id="contador">0/500</span></p>
            @error('message')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
            @if (session()->has('message'))
                <p class="text-sm text-red-500 font-semibold">{{ session('message') }}</p>
            @endif
        </div>
    </div>
    <div class="flex gap-2 justify-center">
        <button type="button" wire:click='save'
            class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Enviar
        </button>
    </div>
</div>

@push('js')
    <script>
        // Obtén el textarea y el elemento donde mostrarás el contador
        var textarea = document.getElementById("message");
        var contador = document.getElementById("contador");

        // Agrega un evento de entrada al textarea
        textarea.addEventListener("input", function(e) {
            const target = e.target;
            const longitudMax = target.getAttribute('maxlength');
            const longitudAct = target.value.length;
            contador.innerHTML = `${longitudAct}/${longitudMax}`;
        });
    </script>
@endpush
