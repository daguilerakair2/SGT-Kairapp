<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\SubStoreProduct;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendProductUpdateToMobile implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Product $product;
    protected SubStoreProduct $subStoreProduct;
    protected array $photos_paths;

    /**
     * Create a new job instance.
     */
    public function __construct(Product $product, SubStoreProduct $subStoreProduct, array $photos_paths)
    {
        $this->product = $product;
        $this->subStoreProduct = $subStoreProduct;
        $this->photos_paths = $photos_paths;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $httpClient = new Client();
        $url = config('app.cloud_function_product_prod').'/update-product/'.$this->product->productMobileId;
        logger($this->subStoreProduct->price);
        try {
            $response = $httpClient->put($url, [
                'json' => [
                    'name' => $this->product->name,
                    'description' => $this->product->description,
                    'price' => $this->subStoreProduct->price,
                    'stock' => $this->subStoreProduct->stock,
                    // Categories
                    'photo_urls' => $this->photos_paths,
                ],
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            // Manejo de errores
            logger()->error('Error en la solicitud Guzzle: '.$e->getMessage());
        }
    }
}
