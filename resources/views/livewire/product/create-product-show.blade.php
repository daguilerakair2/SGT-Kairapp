@push('dropzone')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

<div class="mt-32 sm:my-0 bg-gray-100 p-4 rounded-sm shadow-[0px_3px_10px_0px_#2d3748]">
    <div class="lds-hourglass"></div>
    <div wire:ignore.self>
        {{-- Input for product name --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                Nombre
            </label>
            <input wire:model="name" type="text" name="floating_name" id="floating_name"
                class="bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:ring-green-custom-500 focus:border-green-custom-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input for product description --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_repeat_password" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                Descripción
            </label>
            <textarea wire:model="description" name="description" id="description" rows="4" maxlength="1000"
                class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 resize-none rounded-lg border border-gray-500 focus:ring-green-custom-500 focus:border-green-custom-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required></textarea>
            @error('description')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Grid for price and stock inputs --}}
        <div class="grid md:grid-cols-2 gap-4 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_first_name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                    Precio
                </label>
                <input wire:model="price" type="text" name="floating_first_name" id="floating_first_name"
                    class="bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:ring-green-custom-500 focus:border-green-custom-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required />
                @error('price')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input for product stock --}}
            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_last_name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                    Cantidad disponible
                </label>
                <input wire:model="stock" type="text" name="floating_last_name" id="floating_last_name"
                    class="bg-gray-50 border border-gray-500 text-gray-900 text-md rounded-lg focus:ring-green-custom-500 focus:border-green-custom-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=" " required />
                @error('stock')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- <div class="relative overflow-x-auto w-72 sm:w-full sm:rounded-lg mb-8">
            <div
                class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-start">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div
                        class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-500 rounded-lg w-44 sm:w-72 bg-gray-50 focus:ring-green-custom-500 focus:border-green-custom-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Busca tu categoría">
                </div>

                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>

                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-yellow-400 rounded-lg border border-yellow-400 hover:bg-yellow-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 text-white dark:text-white hover:animate-spin" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div> --}}

        <div class="">
            <div>
                <label for="categories" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                    Seleccione las categorías del producto
                </label>
                <div class="flex flex-col md:flex-row gap-4 w-auto">
                    <div class="scrollable-list max-w-max">
                        <ul class="">
                            <div class="flex flex-row gap-2 overflow-x-auto">
                                @foreach ($categories as $category)
                                    <li>
                                        <input wire:click="addCategory({{ $category }})" type="checkbox"
                                            id="{{ $category->id }}-option" value="" class="hidden peer"
                                            required="">
                                        <label for="{{ $category->id }}-option"
                                            class="inline-flex items-center justify-center w-10/12 p-2 px-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="flex flex-row items-center gap-1">
                                                <svg class="mx-auto my-auto w-5 h-5 text-sky-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M15.2 6H4a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h11.2c.3 0 .6-.1.7-.3l4.5-5c.3-.4.3-1 0-1.4l-4.5-5a1 1 0 0 0-.7-.3Z" />
                                                </svg>
                                                <div class="w-full text-sm font-semibold">{{ $category->name }}</div>
                                            </div>
                                        </label>
                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                    <div>
                        {{ $categories->links('vendor.livewire.tailwind') }}
                    </div>
                </div>
            </div>
        </div>

        <label for="selectedCategories" class="block my-4 mb-2 text-md font-medium text-black dark:text-white">
            Categorias seleccionadas
        </label>
        <div class="rounded-lg border border-gray-500 my-4 mx-auto h-32 w-auto">
            @foreach ($selectedCategories as $key => $category)
                <span id="badge-dismiss-dark" wire:key="{{ $key }}"
                    class="cursor-pointer inline-flex items-center px-2 py-1 ml-2 my-2 me-2 text-sm font-medium text-gray-800 bg-gray-300 hover:bg-gray-300 transition-all rounded dark:bg-gray-700 dark:text-gray-300">
                    {{ $category['name'] }}
                    <button wire:click="removeCategory('{{ $key }}')"
                        class="inline-flex items-center p-1 ms-2 text-sm text-gray-400 bg-transparent rounded-sm hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300"
                        data-dismiss-target="#badge-dismiss-dark" aria-label="Remove">
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Remove badge</span>
                    </button>
                </span>
            @endforeach
        </div>

        {{-- Dropzone for uploading images --}}
        <div class="mb-6">
            <label for="images" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                Subir imagenes
            </label>
            <form action="{{ route('dropzone.storeTemp') }}" method="POST" enctype="multipart/form-data"
                id="image-upload" class="dropzone border-dashed border-2">
                @csrf
            </form>
            <input wire:model='images' hidden />
            @error('images')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Buttons for submitting and returning --}}
    <div wire:loading.remove wire:target="save" class="flex gap-2 justify-center">
        <button wire:click="save" wire:loading.attr="disabled" @if ($disabledButton) disabled @endif
            class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Agregar Producto
        </button>
        <button wire:click="returnInventory"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Volver
        </button>
    </div>
    <div class="flex justify-center">
        <div wire:loading wire:target="save" class="text-center">
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

@push('js')
    <script type="text/javascript">
        // Get the CSRF token from the meta tag in the document head
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        // Listen for the Livewire initialized event
        document.addEventListener('livewire:initialized', () => {
            // Create a new Dropzone instance with specified options
            const dropzone = new Dropzone("#image-upload", {
                dictDefaultMessage: "Haz click aqui para subir las imagenes de tu producto",
                maxFiles: 5,
                maxFileSize: 2,
                acceptedFiles: ".jpeg,.jpg,.png, .webp, .heif,.heic,.hevc",
                addRemoveLinks: true,
                dictRemoveFile: "Borrar imagen",
                dictFallbackMessage: "Tu navegador no soporta la carga de archivos mediante arrastrar y soltar.",
                dictInvalidFileType: "No puedes subir archivos con esa extension.",
                dictMaxFilesExceeded: "No puedes subir más archivos. Límite alcanzado.",
                dictFileTooBig: "El archivo es demasiado grande. Tamaño máximo de archivo: 2MB.",
            });

            // Event listener for a successful file upload
            dropzone.on('success', function(file, response) {
                // Dispatch Livewire event to add the uploaded image
                const {
                    name,
                    type,
                    size
                } = file;

                const imageInfo = {
                    path: response,
                    name,
                    extension: type.split('/')[1],
                    size: formatBytes(size),
                }

                // console.log(imageInfo);
                @this.dispatch('addImage', {
                    imageInfo
                });
            });

            // Event listener for removing a file
            dropzone.on('removedfile', async function(file, message) {
                try {
                    // Extract the image URL from the response
                    const imageUrl = file.xhr.response;
                    const imageUrlFormatted = imageUrl.replaceAll('"', '');
                    const imageUrlFormattedPath = imageUrlFormatted.replace(/\\\//g, '/');

                    // Format the image response and dispatch Livewire event to remove the image
                    @this.dispatch('removeImage', {
                        path: imageUrlFormattedPath,
                    });
                } catch (error) {
                    console.error('Error al eliminar la imagen del servidor.');
                }
            });
        });

        function formatBytes(bytes) {
            let kilobytes = bytes / 1024;
            let megabytes = kilobytes / 1024;

            if (megabytes >= 1) {
                return megabytes.toFixed(2) + " MB";
            } else {
                return kilobytes.toFixed(2) + " KB";
            }
        }
    </script>
@endpush
