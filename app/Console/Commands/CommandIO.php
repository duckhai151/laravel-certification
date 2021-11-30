<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CommandIO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:io';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CommandIO';

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
        //Ask
        if ($this->confirm('Do you wish to IO?', true)) {
            $name = $this->ask('What is your name?');
            $nameAnticipate = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
            $nameChoice = $this->choice(
                'What is your name?',
                ['Taylor', 'Dayle'],
                $defaultIndex = 1
            );
            $password = $this->secret('What is your password?');
        }

        //Progress Bars & Table
        if ($this->confirm('Do you wish to progess bar?', true)) {
            $users = User::all();
            $bar = $this->output->createProgressBar(count($users));
            $bar->start();
            foreach ($users as $user) {
                $bar->advance();
            }
            $this->table(
                ['Name', 'Email'],
                User::all(['name', 'email'])->toArray()
            );
            $bar->finish();
        }

        //Notification
        $this->info('Success');
        $this->newLine();
        $this->error('Error');
        $this->newLine();
        $this->line('Line');
        return Command::SUCCESS;
    }
}
