<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use PhpMqtt\Client\Facades\MQTT;

class MqttPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 240;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mqtt = MQTT::connection();

        $mqtt->subscribe('MainChannel', function (string $topic, string $message) {
            echo sprintf("Receiving\n");
            
            $message = Message::create([
                'topic' => $topic,
                'content' => $message
            ]);
        }, 1);

        $mqtt->loop(true);
        // $mqtt->disconnect();
    }
}
