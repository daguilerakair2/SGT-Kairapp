<?php

namespace App\Livewire\product;

use App\Http\Controllers\DropzoneController;
use App\Jobs\SendProductToMobile;
use App\Livewire\Product\ProductsShow;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImages;
use App\Models\SubStore;
use App\Models\SubStoreProduct;
use App\Notifications\CreatedProduct;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateProductShow extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Product attributes
    public $name;
    public $description;
    public $price;
    public $images = []; // Contain to temporal images
    public $imagesServer = []; // Contain to images in server
    public $stock;
    public $category;
    public $categoriesArray = [];
    public $subStore;

    public $selectedCategories = [];

    public $disabledButton = false; // Controls button state
    public $characteristics = []; // Holds product characteristics

    // Event listeners for Livewire components
    protected $listeners = ['render', 'addImage', 'removeImage'];

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
            'images' => 'required',
            // 'category' => 'required',
            'characteristics.*.value' => 'required',
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

    /**
     * Redirect to inventory page.
     */
    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    /**
     * Handle category selection change and load relevant characteristics.
     */
    public function changedSelectCategory()
    {
        $category = Category::find($this->category);

        if ($category) {
            $this->characteristics = [];
            $characteristicsORM = $category->obtainCharacteristiCategories;

            $characteristics = [];
            foreach ($characteristicsORM as $characteristic) {
                $characteristic_category_id = $characteristic->id;
                $nameCharacteristic = $characteristic->getCharacteristic->name;
                $characteristic_id = $characteristic->characteristic_id;
                $category_id = $characteristic->category_id;

                $characteristics[] = [
                    'characteristic_category_id' => $characteristic_category_id,
                    'name' => $nameCharacteristic,
                    'characteristic_id' => $characteristic_id,
                    'category_id' => $category_id,
                    'value' => '',
                ];
            }

            $this->characteristics = $characteristics;
        } else {
            $this->characteristics = [];
        }
    }

    /**
     * Remove an image from the product images array.
     *
     * @param string $path Path of the image to remove
     */
    public function removeImage($path)
    {
        $deleteImage = $path;
        $this->images = array_filter($this->images, function ($value) use ($deleteImage) {
            return $value['path'] !== $deleteImage;
        });
        $this->skipRender();
    }

    /**
     * Add an image to the product images array.
     */
    public function addImage($imageInfo)
    {
        $image = [
            'path' => $imageInfo['path'],
            'name' => $imageInfo['name'],
            'extension' => $imageInfo['extension'],
            'size' => $imageInfo['size'],
        ];
        $this->images[] = $image;
        $this->skipRender();
    }

    public function saveTempImages($path)
    {
        $this->images[] = $path;
    }

    /**
     * Handle the product saving process.
     */
    public function save()
    {
        // $this->addCategoriesToProduct();
        $this->validate($this->rules());

        $this->disabledButton = true;

        $store = session('store');
        $product = $this->createProduct($store);

        $this->addImagesToServer();
        $photos_paths = $this->addImagesToProduct($product);

        $subStoreProduct = $this->createSubStoreProduct($product);

        $categories_names = $this->addCategoriesToProduct($product);

        $subStore = SubStore::find($this->subStore);

        // Send product to mobile app
        SendProductToMobile::dispatch($product, $subStoreProduct, $subStore, $photos_paths, $categories_names);

        // Post-creation actions such as notifications and redirection.
        $this->notifyProductCreation($product, $store);
        $this->dispatch('render')->to(ProductsShow::class);
        toastr()->success('El producto fue creado con éxito', 'Producto creado!');
        $this->returnInventory();
    }

    /**
     * Add an category to array.
     *
     * @param object $category The category to add
     */
    public function addCategory($category)
    {
        // dd($category['id']);
        $exists = in_array($category['id'], array_column($this->selectedCategories, 'category_id'));

        if (!$exists) {
            // $this->selectedCategories[]
            $newKey = uniqid();
            $newCategory = [
                'key' => $newKey,
                'category_id' => $category['id'],
                'name' => $category['name'],
            ];
            $this->selectedCategories[$newKey] = $newCategory;
        }
    }

    /**
     * Remove an category from array.
     *
     * @param string $deleteCategoryKey Key of the category to remove
     */
    public function removeCategory($deleteCategoryKey)
    {
        unset($this->selectedCategories[$deleteCategoryKey]);

        $auxSelectedCategories = $this->selectedCategories;
        $this->reset('selectedCategories');
        $this->selectedCategories = $auxSelectedCategories;
    }

    private function addCategoriesToProduct($product)
    {
        // dd($this->selectedCategories);

        foreach ($this->selectedCategories as $category) {
            $newItem = array_intersect_key($category, array_flip(['category_id']));
            $newItem['product_id'] = $product->id;
            $array[] = $newItem;
        }

        ProductCategory::insert($array);

        $categories_names = array_map(function ($category) {
            return $category['name'];
        }, $this->selectedCategories);

        return $categories_names;
    }

    /**
     * Create a new product in the database.
     *
     * @param mixed $store The store session data
     *
     * @return Product The created product instance
     */
    private function createProduct($store)
    {
        // Creates a new product record in the database with the provided details.
        return Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'pathImage' => 'default/path', // update this accordingly
            'price' => $this->price,
            'variablePrice' => false,
            'store_rut' => $store->rut,
        ]);
    }

    private function addImagesToServer()
    {
        $controller = app(DropzoneController::class);

        try {
            foreach ($this->images as $image) {
                $request = Request::create('/upload', 'POST', ['imagePath' => $image['path']]);
                $response = $controller->store($request);
                logger()->info('Response Content: '.$response->getContent());

                $responseData = json_decode($response->getContent(), true);
                $this->imagesServer[] = $responseData['imagePath'];
            }
        } catch (\Exception $e) {
            // Handle any exception and return a JSON error response
            logger()->error('Error al eliminar la imagen. Detalles: '.$e->getMessage());
        }
    }

    /**
     * Link the created product to a sub-store.
     *
     * @param Product $product The product instance
     */
    private function createSubStoreProduct(Product $product)
    {
        // Associates the product with a sub-store by creating a SubStoreProduct record.
        $subStoreProduct = SubStoreProduct::create([
            'price' => $this->price,
            'stock' => $this->stock,
            'status' => true,
            'delete' => false,
            'product_id' => $product->id,
            'sub_store_id' => $this->subStore,
        ]);

        return $subStoreProduct;
    }

    /**
     * Add images to the created product.
     *
     * @param Product $product The product instance
     */
    private function addImagesToProduct(Product $product)
    {
        // Iterates over the images array and creates a ProductImages record for each image.
        foreach ($this->imagesServer as $index => $image) {
            ProductImages::create([
                'path' => 'products/'.$image,
                'name' => $this->images[$index]['name'],
                'size' => $this->images[$index]['size'],
                'extension' => $this->images[$index]['extension'],
                'product_id' => $product->id,
            ]);
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
     * Link the created product to a category.
     *
     * @param Product  $product       The product instance
     * @param Category $existCategory The category instance
     */
    private function linkProductToCategory(Product $product, Category $existCategory)
    {
        // Creates a link between the product and a category in the ProductCategory table.
        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => $existCategory->id,
        ]);
    }

    /**
     * Send a notification about the product creation.
     *
     * @param Product $product  The product instance
     * @param mixed   $subStore The sub-store session data
     */
    private function notifyProductCreation(Product $product, $subStore)
    {
        // Sends a notification (e.g., to Slack) about the new product.
        Notification::route('slack', config('services.slack.notifications.slack_created_product'))
            ->notify(new CreatedProduct([
                'name' => $product->name,
                'store_name' => $subStore->name,
                 'stock' => $subStore->stock,
                'price' => $product->price,
                'rut' => $subStore->rut,
            ]));
    }

    public function addShield()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'name' => '',
        ];
        $this->categoriesArray[$newKey] = $newShield;
        // dd($this->categoriesArray);
    }

    public function removeShield($key)
    {
        $nowCount = count($this->categoriesArray);
        if ($nowCount === 1) {
            session()->flash('categoryMessage', 'La categoría debe poseer al menos una característica.');
        } else {
            unset($this->categoriesArray[$key]);
            $auxCharacteristics = $this->categoriesArray;
            $this->reset('categoriesArray');
            $this->categoriesArray = $auxCharacteristics;
        }
    }

    public function mount()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'name' => '',
        ];
        $this->categoriesArray[$newKey] = $newShield;
    }

    /**
     * Render the Livewire component with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // obtain categories system
        $categories = Category::orderBy('name', 'asc')->paginate(4);

        // obtain substores to selected store.
        $store = session('store');
        $subStores = $store->subStores()->get();

        return view('livewire.product.create-product-show', compact('categories', 'subStores'));
    }
}
