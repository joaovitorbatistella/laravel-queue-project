<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Subscriber;

class ProcessSubscriber implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscriber;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Processando subscriber: '.$this->subscriber['EMAIL']);

            if($this->subscriber['EMAIL'] === 'teste07@gmail.com') {
                Log::warning('to fail');
                throw new \Exception("Email bloqueado!");
            }

            Subscriber::create([
                "name"  => $this->subscriber['NAME'],
                "email" => $this->subscriber['EMAIL'],
            ]);

            Log::info('Subscriber '.$this->subscriber['EMAIL'].' processado');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->fail($e);
        }
    }
}
