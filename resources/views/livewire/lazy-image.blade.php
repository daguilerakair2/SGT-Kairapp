<div wire:init="loadImage" wire:loading.remove>
    <!-- Contenedor del spinner -->
    <div id="spinner" wire:loading wire:target="loadImage">
        <img src="{{ asset('images/spinner.gif') }}" alt="Cargando...">
    </div>

    <!-- Imagen con atributo loading="lazy" -->
    <img id="lazy-image" src="{{ asset('images/placeholder.jpg') }}" data-src="{{ $imageSrc }}" loading="lazy" alt="Descripción de la imagen">
</div>
