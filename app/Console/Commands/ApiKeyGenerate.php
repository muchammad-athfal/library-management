<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApiKeyGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:api-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API key';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = str_random(60);
        $this->info('Your API key is: ' . $apiKey);
        $this->info('Copy and paste it into your .env file in the API_KEY variable');
    }
}
