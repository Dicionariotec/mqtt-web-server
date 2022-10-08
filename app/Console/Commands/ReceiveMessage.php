<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Exception;
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

        $mqtt->subscribe('MainChannel', function (string $topic, string $message) use ($mqtt) {
            echo sprintf("Receiving\n");
            
            $message = Message::create([
                'topic' => $topic,
                'content' => $message
            ]);

            if ($message->exists()) {
                $mqtt->interrupt();
            }
        }, 1);

        $mqtt->loop(true);
        $mqtt->disconnect();

        return Command::SUCCESS;
    }
}
