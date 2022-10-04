<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use PhpMqtt\Client\Facades\MQTT;

class ReceiveMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receive:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Receive MQTT Protocol message';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe('MainChannel', function (string $topic, string $message) {
            echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
        }, 1);
        $mqtt->loop(true);

        return Command::SUCCESS;
    }
}
