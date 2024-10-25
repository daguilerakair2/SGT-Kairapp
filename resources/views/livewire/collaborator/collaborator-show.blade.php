<div class="mt-36 sm:mt-0">

    @if (session()->has('password'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Trabajador creado con éxito</span>
            Recuerde suministrar su contraseña al trabajador creado.
            <button id="btn">
                Mostrar contraseña
            </button>
            <input type="hidden" id="password" name="password" value="{{ session('password') }}">
        </div>
    @endif

    <div class="flex justify-end my-4">
        <a href="{{ route('collaborator.create') }}"
            class="text-white bg-pink-custom-600 hover:bg-pink-custom-850 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Agregar Trabajador
        </a>

    </div>
    @if ($storeCollaborators->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Correo electrónico
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sucursal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storeCollaborators as $storeCollaborator)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-36 px-6 py-4 font-semibold text-gray-900">
                                {{ $storeCollaborator->userInfo->name }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $storeCollaborator->userInfo->email }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                @if ($storeCollaborator->subStoreUser)
                                    {{ $storeCollaborator->subStoreUser->name }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $storeCollaborator->roleUser->name }}
                            </td>
                            @if ($storeCollaborator->status)
                            <td class="px-6 py-4 font-semibold text-green-500">
                                HABILITADO
                            </td>
                            @else
                            <td class="px-6 py-4 font-semibold text-red-500">
                                DESHABILITADO
                            </td>
                            @endif

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <div class="flex gap-4">
                                <div class="flex flex-col items-center my-auto">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input wire:click="receiveUpdates({{ $id = $storeCollaborator->id }})" type="checkbox" value="" class="sr-only peer" @if($storeCollaborator->status) checked @endif>
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                    <p class="font-semibold text-xs">Estado</p>
                                </div>
                                <button wire:click="$dispatch('deleteUser', '{{{ $storeCollaborator->id }}}')" type="button" class="flex flex-col items-center my-auto">
                                    <svg class="w-5 h-5 text-red-500 hover:text-red-700 transition-all"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 18 20">
                                        <path
                                            d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                    </svg>
                                    <p class="font-semibold text-xs">Eliminar</p>
                                </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <img class="mx-auto w-1/5 md:w-1/12 " src="{{ asset('/images/wind-unscreen.gif') }}"/>
        <p class="font-bold text-black text-2xl text-center">No hay trabajadores que formen parte de la tienda</p>
    @endif
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.getElementById('password').value;
            if (password) {
                Swal.fire({
                    title: 'Recuerda copiar la contraseña de tu trabajador',
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
        // console.log(password);
        if(button){
            button.addEventListener('click', () => {
                const password = document.getElementById('password').value;
                console.log(password);
                Swal.fire({
                    title: 'Recuerda copiar la contraseña de tu trabajador',
                    text: password,
                    icon: 'info',
                    confirmButtonColor: '#FF5C77',
                    confirmButtonText: 'Cancelar',
                })
            });
        }
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('deleteUser', (user) => {
                console.log('select')
                Swal.fire({
                    title: '¿Estás seguro que quieres eliminar a este trabajador?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4DD091',
                    cancelButtonColor: '#FF5C77',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('delete', {
                            id: user
                        });
                        Swal.fire(
                            'Trabajador eliminado!',
                            'El trabajador ha sido eliminado con éxito.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
