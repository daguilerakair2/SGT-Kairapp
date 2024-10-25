<?php

namespace App\Jobs;

use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendProductUpdateStatusToMobile implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Product $product;
    protected bool $status;

    /**
     * Create a new job instance.
     */
    public function __construct(Product $product, bool $status)
    {
        $this->product = $product;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $httpClient = new Client();
        $url = config('app.cloud_function_product_prod').'/update-status/'.$this->product->productMobileId;
        logger()->info('URL: '.$url);
        try {
            $httpClient->put($url, [
                'json' => [
                    'updateStatus' => $this->status,
                ],
            ]);
        } catch (GuzzleException $e) {
            logger()->error('Error en la solicitud Guzzle: '.$e->getMessage());
        }
    }
}
