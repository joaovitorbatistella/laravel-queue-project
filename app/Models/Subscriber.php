<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\ProcessSubscriber;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

use Illuminate\Support\Facades\Log;

class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'subscriber';
  
    protected $primaryKey = 'id';
  
    protected $fillable = [
        'id',
        'name',
        'email',
    ];

    public function handleBatch($subs)
    {
        $batch = Bus::batch([])
        ->finally(function (Batch $batch) {
            Log::info('finally');
            $jb = $this->batchValues($batch);
            
            if($jb['progress'] === 100) {
                Log::debug('eh pra ser 100', ['progress'=>$jb['progress']]);
                // $this->finishJobBatch($batch);
            
                // SubscriberProcessed::dispatch([
                //     "importUid" => $this->import_uid,
                //     "progress" => $jb,
                // ]);

                // ImportProcessFinished::dispatch($this->refresh());
            }
            else {
                Log::debug('eh pra ser < 100', ['progress'=>$jb['progress']]);

                // SubscriberProcessed::dispatch([
                //     "importUid" => $this->import_uid,
                //     "progress" => $jb,
                // ]);
            }
        })
        ->allowFailures()
        ->name('import-subscribers-queue')
        ->onQueue('importSubscribersQueue')
        ->dispatch();

        if(filled($batch)){               
              foreach($subs as $sub) {               
                $batch->add(new ProcessSubscriber($sub));
              }

            return $batch;
        }
    }

    public static function batchValues($b) {
        $processedJobs = $b->processedJobs() + ($b->failedJobs);
        $progress = (int) ($b->totalJobs > 0 ? round(($processedJobs / $b->totalJobs) * 100) : 0);
        return [
          "progress"=>$progress,
          "total"=>$b->totalJobs,
          "done"=> $processedJobs,
          "fail"=>$b->failedJobs,
        ];
    }

    public function finishJobBatch(Batch $batch){
        self::withoutEvents(function () use ($batch) {
            $batch->cancel();
        });
    }
}
