<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Store;
use App\Models\SubStore;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendStoreToMobile implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $store;
    protected $subStore;
    protected $city;
    protected $schedulesSubstore;

    /**
     * Create a new job instance.
     */
    public function __construct(Store $store, SubStore $subStore, City $city, array $schedulesSubstore)
    {
        $this->store = $store;
        $this->subStore = $subStore;
        $this->city = $city;
        $this->schedulesSubstore = $schedulesSubstore;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $httpClient = new Client();
        $url = config('app.cloud_function_store_prod').'/createStore';

        try {
            $response = $httpClient->post($url, [
                'json' => [
                    'name' => $this->subStore->name,
                    'description' => $this->store->description,
                    'address' => $this->subStore->address,
                    'city' => $this->city->name,
                    'phone' => $this->subStore->phone,
                    'status' => false,
                    'reputation' => 0.0,
                    'profile_photo_url' => $this->store->pathProfile,
                    'background_photo_url' => $this->store->pathBackground,
                ],
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            $this->subStore->update(['subStoreMobileId' => $responseBody['storeId']]);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
            logger()->error('Error en la solicitud Guzzle: '.$e->getMessage());
        }
    }
}
