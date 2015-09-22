<?php namespace Alfredoem\Soda\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;


class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'soda:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Soda scaffolding into the application';


    public function handle()
    {
        $this->installMigrations();
    }

    protected function installMigrations()
    {
        copy(
            SODA_PATH . '/resources/stubs/database/migrations/2015_22_09_aloha.php', database_path('migrations/2015_22_09_aloha.php'));

    }




}
