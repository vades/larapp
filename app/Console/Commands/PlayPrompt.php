<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use function Laravel\Prompts\text;
use function Laravel\Prompts\form;
use function Laravel\Prompts\spin;
use function Laravel\Prompts\select;
use function Laravel\Prompts\pause;

class PlayPrompt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:play-prompt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running play-prompt');
        $response = spin(
            message: 'Fetching response...',
            callback: fn () => Http::get('http://example.com')
        );
        $role = select(
            label: 'What role should the user have?',
            options: ['Member', 'Contributor', 'Owner']
        );
        $this->info($role);
        $responses = form()
            ->text('What is your name?', required: true)
            ->password('What is your password?', validate: ['password' => 'min:8'])
            ->confirm('Do you accept the terms?')
            ->submit();
        $name = text('What is your name?');
        $this->info($name);
    }
}
