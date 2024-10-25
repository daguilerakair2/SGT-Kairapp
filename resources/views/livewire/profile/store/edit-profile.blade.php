<div>
    <!-- Modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Editar Perfil
        </h3>
    </div>
    <!-- Modal body -->
    <div class="p-4 md:p-5 space-y-4">
        <div class="grid grid-cols-2 gap-2">
            <button wire:click="changeBanner">
                <img class="h-auto mx-auto w-full max-w-sm rounded-lg" loading="lazy"
                    src="https://alphakairappbucket.s3.sa-east-1.amazonaws.com/kairapp/storeBanners/lowResolution/Kairapp+-+Chocolateria+banner.jpg"
                    alt="image description">
            </button>
            <button wire:click="changeBanner">
                <img class="h-auto mx-auto w-full max-w-sm rounded-lg" loading="lazy"
                    src="https://alphakairappbucket.s3.sa-east-1.amazonaws.com/kairapp/storeBanners/Kairapp+-+Electro%CC%81nica.jpg"
                    alt="image description">
            </button>
            <button wire:click="changeBanner">
                <img class="h-auto mx-auto w-full max-w-sm rounded-lg" loading="lazy"
                    src="https://alphakairappbucket.s3.sa-east-1.amazonaws.com/kairapp/storeBanners/Kairapp+-+Joyas++-+banner+-+2.jpg"
                    alt="image description">
            </button>
            <button wire:click="changeBanner">
                <img class="h-auto mx-auto w-full max-w-sm rounded-lg" loading="lazy"
                    src="https://alphakairappbucket.s3.sa-east-1.amazonaws.com/kairapp/storeBanners/KairappFloreriaBanner.jpg"
                    alt="image description">
            </button>
        </div>


    </div>
</div>
