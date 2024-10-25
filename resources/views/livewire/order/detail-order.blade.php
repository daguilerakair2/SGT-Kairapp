<div>
    <p class=" text-black text-center text-xl font-semibold py-4">Pedido #{{ $order->orderMobile_id }}</p>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio de compra
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderProducts as $orderProduct)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-16 h-16 sm:w-24 sm:h-24" src="{{ config('app.aws_url') . $orderProduct->subStoreProductDates->productDates->productImages->first()->path }}"
                            alt="product-img-{{ $orderProduct->subStoreProductDates->productDates->productImages->first()->id }}">
                        </th>
                        <td class="px-6 py-4">
                            {{ $orderProduct->subStoreProductDates->productDates->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $orderProduct->quantity }}
                        </td>
                        <td class="px-6 py-4">
                            {{ number_format($orderProduct->buyPrice, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
