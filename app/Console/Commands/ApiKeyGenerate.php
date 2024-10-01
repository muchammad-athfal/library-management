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
        $this->info('Keep this safe. You will not be able to see it again.');
        $this->info('If you lose your API key, you will not be able to regenerate it.');
    }
}
