<?php

namespace App\Livewire;

use Livewire\Component;

class LazyImage extends Component
{
    public $imageSrc;
    public $showSpinner = true;

    public function loadImage()
    {
        // Simula una carga de imagen, podrías cargar la imagen real aquí si es necesario
        sleep(2);

        $this->showSpinner = false;
    }

    public function mount($imageSrc)
    {
        $this->imageSrc = $imageSrc;
    }

    public function render()
    {
        return view('livewire.lazy-image');
    }
}
