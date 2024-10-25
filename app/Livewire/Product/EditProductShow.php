<?php

namespace App\Livewire\product;

use App\Http\Controllers\DropzoneController;
use App\Jobs\SendProductUpdateToMobile;
use App\Livewire\Product\ProductsShow;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImages;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProductShow extends Component
{
    use WithFileUploads;

    public $selectSubStoreProduct;
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $images = [];
    public $newImages;
    public $imagesServer = []; // Contain to images in server
    public $deleteImagesPath;
    public $deleteImagesID;
    public $maxImages = 5;
    public $selectedCategories = [];

    public $disabledButton = false; // Controls button state

    // Event listeners for Livewire components
    protected $listeners = ['render', 'addNewImage', 'save', 'returnInventory'];

    /**
     * Validation rules for product creation.
     *
     * @return void
     */
    protected function rules()
    {
        return [
            'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s\-_]+$/',
            'description' => 'required|max:255',
            'price' => 'required|regex:/^[1-9]\d*$/',
            'stock' => 'required|regex:/^[1-9]\d*$/',
        ];
    }

    /**
     * HTTP client for making asynchronous requests.
     *
     * @var Client
     */
    private $httpClient;

    /**
     * Initialize the component.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    /**
     * Save the product in the database and server.
     */
    public function save()
    {
        $photos_paths = [];

        $this->disabledButton = true;
        $this->validate($this->rules());

        $avaliableImages = $this->verifyImages();

        if ($avaliableImages !== 0 && $this->newImages) {
            $photos_paths = $this->addImagesToProduct($avaliableImages);
        } else {
            $photos_paths = $this->obtainImages($this->selectSubStoreProduct->productDates);
        }

        // Search the product
        $this->selectSubStoreProduct->stock = $this->stock;
        $this->selectSubStoreProduct->price = $this->price;
        $this->selectSubStoreProduct->save();

        $updateProduct = $this->selectSubStoreProduct->productDates;
        $updateProduct->name = $this->name;
        $updateProduct->description = $this->description;
        $updateProduct->save();

        // Send product to mobile app
        SendProductUpdateToMobile::dispatch($updateProduct, $this->selectSubStoreProduct, $photos_paths);

        $this->dispatch('render')->to(ProductsShow::class);
        toastr()->success('El producto fue actualizado con éxito', 'Producto actualizado!');
        $this->returnInventory();
    }

    /**
     * Verify if the images are complete.
     */
    private function verifyImages()
    {
        $nowImages = count($this->images);

        // dd($this->deleteImagesID, $this->deleteImagesPath);
        if ($this->deleteImagesID) {
            // Delete database images
            $this->deleteImagesServer();
            $this->deleteNewImagesDatabases();
        }

        // Calculate avaliable images
        $avaliableImages = $this->maxImages - $nowImages;

        return $avaliableImages;
    }

    /**
     * Add images to the created product.
     */
    private function addImagesToProduct($avaliableImages)
    {
        // dd($this->newImages[0]);
        $this->addImagesToServer();
        $product = $this->selectSubStoreProduct->productDates;

        $newImagesQuantity = count($this->newImages);
        // Calculate avaliable images
        $avaliableImages = $this->maxImages - $newImagesQuantity;

        if ($newImagesQuantity < $avaliableImages) {
            $avaliableImages = $newImagesQuantity;
        }

        for ($i = 0; $i < $avaliableImages; ++$i) {
            if ($this->newImages[$i]) {
                $image = $this->newImages[$i];
                $imageServer = $this->imagesServer[$i];
                $path = 'products/'.$imageServer;

                // Iterates over the images array and creates a ProductImages record for each image.
                ProductImages::create([
                    'name' => $image['name'],
                    'path' => $path,
                    'extension' => $image['extension'],
                    'size' => $image['size'],
                    'product_id' => $product->id,
                ]);
            }
        }

        // Obtains the paths of the images associated with the product.
        $productImages = $product->productImages()->get();

        // Prepare Paths for Mobile App
        $paths = $productImages->pluck('path')->map(function ($path) {
            return config('app.aws_url').$path;
        })->toArray();

        return $paths;
    }

    /**
     * Add images to the server.
     */
    private function addImagesToServer()
    {
        $controller = app(DropzoneController::class);

        try {
            foreach ($this->newImages as $image) {
                $request = Request::create('/upload', 'POST', ['imagePath' => $image['path']]);
                $response = $controller->store($request);

                $responseData = json_decode($response->getContent(), true);
                $this->imagesServer[] = $responseData['imagePath'];
            }
        } catch (\Exception $e) {
            // Handle any exception and return a JSON error response
            logger()->error('Error al eliminar la imagen. Detalles: '.$e->getMessage());
        }
    }

    /**
     * Obtain images of the current product.
     */
    private function obtainImages($updateProduct)
    {
        $product = Product::find($updateProduct->id);

        // Obtains the paths of the images associated with the product.
        $productImages = $product->productImages()->get();

        // Prepare Paths for Mobile App
        $paths = $productImages->pluck('path')->map(function ($path) {
            return config('app.aws_url').$path;
        })->toArray();

        return $paths;
    }

    /**
     * Delete new images in server.
     */
    private function deleteNewImagesServer()
    {
        foreach ($this->newImages as $image) {
            $this->dispatch('dropzone.delete', $image['path']);
        }
    }

    /**
     * Delete imagesPath array in server.
     */
    private function deleteImagesServer()
    {
        $controller = app(DropzoneController::class);

        try {
            foreach ($this->deleteImagesPath as $image) {
                $request = Request::create('/delete-image', 'POST', ['imageUrl' => $image]);
                $controller->delete($request);
            }
        } catch (\Exception $e) {
            // Handle any exception and return a JSON error response
            logger()->error('Error al eliminar la imagen. Detalles: '.$e->getMessage());
        }
    }

    /**
     * Delete imagesID array in database.
     */
    private function deleteNewImagesDatabases()
    {
        $numericIds = array_map('intval', $this->deleteImagesID);
        ProductImages::destroy($numericIds);
    }

    /**
     * Replace the values of the product.
     */
    public function replaceValues()
    {
        $selectProduct = $this->selectSubStoreProduct->productDates;

        $this->name = $selectProduct->name;
        $this->description = $selectProduct->description;
        $this->price = $this->selectSubStoreProduct->price;
        $this->stock = $this->selectSubStoreProduct->stock;

        $arrayImages = $this->formattedArrayImages($selectProduct->productImages);
        $this->images = $arrayImages;
    }

    /**
     * Add new image to the product.
     */
    public function addNewImage($imageInfo)
    {
        $this->newImages[] = $imageInfo;
        $this->skipRender();
    }

    /**
     * Delete local image to the product.
     */
    public function deleteImage($key, $selectedImageID, $selectedImagePath)
    {
        $this->deleteImagesID[] = $selectedImageID;
        $this->deleteImagesPath[] = $selectedImagePath;

        unset($this->images[$key]);

        $auxImages = $this->images;
        $this->reset('images');
        $this->images = $auxImages;
    }

    /**
     * Format the array of images.
     */
    public function formattedArrayImages($images)
    {
        $arrayImages = [];

        foreach ($images as $image) {
            $newKey = uniqid();
            $formattedPath = str_replace('products/', '', $image->path);
            $newShield = [
                'key' => $newKey,
                'id' => $image->id,
                'name' => $image->name,
                'originalPath' => $image->path,
                'path' => $formattedPath,
                'extension' => $image->extension,
                'size' => $image->size,
            ];
            $arrayImages[$newKey] = $newShield;
        }

        return $arrayImages;
    }

    public function mount($selectSubStoreProduct)
    {
        $this->selectedCategories = ProductCategory::where('product_id', $this->selectSubStoreProduct->product_id)->get();
        $this->selectSubStoreProduct = $selectSubStoreProduct;
        $this->replaceValues();
    }

    public function render()
    {
        return view('livewire.product.edit-product-show');
    }
}
