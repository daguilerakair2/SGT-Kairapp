@push('dropzone')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

<div class="mt-32 sm:mt-0 bg-gray-100 p-4 rounded-sm shadow-[0px_3px_10px_0px_#2d3748]">
    <div wire:ignore.self>
        {{-- Input for product name --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre
            </label>
            <input wire:model="name" type="text" name="floating_name" id="floating_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required />
            @error('name')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input for product description --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="floating_repeat_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Descripción
            </label>
            <input wire:model="description" type="text" name="repeat_password" id="floating_repeat_password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder=" " required />
            @error('description')
                <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input for product price and stock --}}
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Precio
                </label>
                <input wire:model="price" type="text" name="floating_first_name" id="floating_first_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=" " required />
                @error('price')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="floating_last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Cantidad disponible
                </label>
                <input wire:model="stock" type="text" name="floating_last_name" id="floating_last_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=" " required />
                @error('stock')
                    <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="selectedCategories" class="block my-4 mb-2 text-md font-medium text-gray-900 dark:text-white">
                Categorias seleccionadas
            </label>
            <div class="rounded-lg border border-gray-300 my-4 mx-auto h-32 w-auto">
                @foreach ($selectedCategories as $category)
                    <span id="badge-dismiss-dark"
                        class="cursor-pointer inline-flex items-center px-2 py-1 ml-2 my-2 me-2 text-sm font-medium text-gray-800 bg-gray-100 hover:bg-gray-300 transition-all rounded dark:bg-gray-700 dark:text-gray-300">
                        {{ $category->category->name }}
                    </span>
                @endforeach
            </div>
        </div>


        {{-- Input for upload images --}}
        <div>
            <label for="floating_repeat_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Imagenes Cargadas
            </label>
            <ul
                class="w-full sm:w-1/2 mb-8 text-xs sm:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @foreach ($this->images as $key => $image)
                    <li wire:key="{{ $key }}"
                        class="w-full flex items-center justify-between px-4 py-2 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex flex-row">
                            <img class="w-12 h-12 mr-2 sm:mr-0 sm:w-16 sm:h-16"
                                src="{{ config('app.aws_url') . $image['originalPath'] }}"
                                alt="product-img-{{ $image['path'] }}">
                            <p class="text-gray-500 my-auto ml-4">{{ $image['size'] }}</p>

                        </div>
                        <button
                            wire:click="deleteImage('{{ $key }}', '{{ $id }}', '{{ $image['path'] }}')">
                            <svg class="w-5 h-5 ml-8 sm:ml-12 text-gray-500 hover:text-gray-800 transition-all cursor-pointer dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- @foreach ($this->images as $image)
            <p class="text-gray-500">{{ $image['path'] }}</p>
        @endforeach --}}

        {{-- Dropzone for uploading images --}}
        <div class="mb-6 {{ count($this->images) === 5 ? 'hidden' : '' }}">
            <label for="images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
    <div wire:loading.remove wire:target="save" class="flex gap-2 justify-center">
        <button wire:click="$dispatch('saveProduct')" wire:loading.attr="disabled"
            @if ($disabledButton) disabled @endif
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Guardar
        </button>
        <button wire:click="$dispatch('return')"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Cancelar
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
                acceptedFiles: ".jpeg,.jpg,.png,.webp,.heif,.heic,.hevc",
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

                console.log(imageInfo);
                @this.dispatch('addNewImage', {
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('saveProduct', () => {
                Swal.fire({
                    title: 'Los cambios realizados no se podrán revertir. ¿Quieres continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4DD091',
                    cancelButtonColor: '#FF5C77',
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Volver',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('save');
                    }
                })
            });

            @this.on('return', () => {
                Swal.fire({
                    title: 'Los cambios realizados se perderán. ¿Quieres continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4DD091',
                    cancelButtonColor: '#FF5C77',
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Volver',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('returnInventory');
                    }
                })
            });
        });
    </script>
@endpush
