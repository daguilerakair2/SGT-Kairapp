<div class="my-32 sm:my-0">
    <div class="flex justify-end my-4">
        <a href="{{ route('order.create') }}"
            class="text-white  bg-pink-custom-600 hover:bg-pink-custom-850 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Agregar Pedido
        </a>
    </div>

    @if ($storeOrders && $storeOrders->count())
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
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storeOrders as $storeOrder)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-32 px-6 py-4">
                                ${{ number_format($storeOrder->subTotal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ date('d/m/Y', strtotime($storeOrder->date)) }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $storeOrder->subStoreDates->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="my-4">
                {{ $storeProducts->links() }}
            </div> --}}
        </div>
    @else
        <p class="font-semibold text-black text-xl text-center">No hay registros en el sistema</p>
    @endif
</div>
