<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class startBookStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book-store:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs migration, seeder and voyager';

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
     * @return mixed
     */
    public function handle()
    {
        $seed = $this->option('seed');

        Artisan::call('migrate:fresh');
        $this->info('All tables migrated successfully!');

        Artisan::call('db:seed');
        $this->info('Seeded successfully!');

        Artisan::call('php artisan voyager:install');
        $this->info('Voyager installed successfully!');

        Artisan::call('php artisan voyager:admin admin@admin.com');
        $this->info('Voyager successfully assigned admin account.');
        }
    }
}
