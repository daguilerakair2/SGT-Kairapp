<div class="mt-36 sm:mt-0">
    @if ($orders && $orders->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Subtotal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre Sucursal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-32 px-6 py-4 font-semibold text-gray-900">
                                {{ number_format($order->subTotal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ date('d/m/Y', strtotime($order->date)) }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $order->subStoreDates->name }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                @if ($order->storeMobile_id !== '1')
                                    <p class="text-yellow-500 font-semibold uppercase">Pendiente</p>
                                @else
                                    <p class="text-green-500 font-semibold uppercase">Despachado</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <div class="flex gap-4">
                                    <button
                                        wire:click="$dispatch('openModal', {component: 'order.detail-order', arguments: {order_id: {{ $order->id }}}})"
                                        class="flex flex-col sm:items-start items-center my-auto">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                            <path
                                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                            <path
                                                d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                        </svg>
                                        <p class="font-semibold text-xs">Ver detalle</p>
                                    </button>

                                    @if ($order->storeMobile_id !== '1')
                                    <button
                                    wire:click="$dispatch('checkOrder', '{{{ $order->id }}}')"
                                    class="bg-pink-custom-600 hover:bg-pink-custom-850 transition-all text-white rounded-lg p-2">
                                    {{-- <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                        <path
                                            d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                    </svg> --}}
                                    Marcar como entregado
                                </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="font-semibold text-black text-xl text-center">No hay pedidos en el sistema</p>
    @endif
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('checkOrder', (order) => {
                console.log(order);
                Swal.fire({
                    title: '¿Estás seguro que quieres marcar este pedido como completado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4DD091',
                    cancelButtonColor: '#FF5C77',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('editOrder', {
                            id: order
                        });
                        // Swal.fire(
                        //     'Estado modificado!',
                        //     'El pedido ha sido marcado como completado.',
                        //     'success'
                        // )
                    }
                })
            });
        });
    </script>
@endpush
