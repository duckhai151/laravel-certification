<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:make-user
                            {name?}
                            {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command make user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            User::insert([
                'name' => $this->argument('name'),
                'email' => $this->option('email'),
                'password' => Hash::make('123456')
            ]);
            $this->info('Success !');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::info($e);
            $this->error($e);
            return Command::FAILURE;
        }
    }
}
