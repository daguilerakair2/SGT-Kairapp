<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendScheduleToMobile implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $schedulesSubstore;
    protected $subStoreId;

    /**
     * Create a new job instance.
     */
    public function __construct(array $schedulesSubstore, string $subStoreId)
    {
        $this->schedulesSubstore = $schedulesSubstore;
        $this->subStoreId = $subStoreId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $httpClient = new Client();
        $url = config('app.cloud_function_store_prod').'/createSchedule';

        try {
            $response = $httpClient->post($url, [
                'json' => [
                    'schedules' => $this->schedulesSubstore,
                    'subStoreId' => $this->subStoreId,
                ],
            ]);
            logger()->info($response->getBody());
        } catch (GuzzleException $e) {
            dd($e->getMessage());
            logger()->error('Error en la solicitud Guzzle: '.$e->getMessage());
        }
    }
}
