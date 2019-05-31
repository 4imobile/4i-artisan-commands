<?php

namespace Rhaarhoff\fouriArtisanCommands\Console\Device\Authentication\Migrations;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Log;
use Symfony\Component\Console\Input\InputOption;

class CreateAllMigrations extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth:migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all custom middleware classes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migrations';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;


    /**
     * @param Filesystem $files
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(Filesystem $files)
    {
        $this->files = $files;

        $this->deleteDefaults();
        $this->createMigration('users');
        sleep(1);
        $this->createMigration('password_resets');
        sleep(1);
        $this->createMigration('devices');
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createMigration($name) {
        $this->line("<info>Creating</info> " . $this->getTableName("create_{$name}_table"));
        if ($this->checkCreated($name)) {
            $this->error('Migration already exists!');
        } else {
            $stubName = $name;
            if ($this->option('otp') && $name == 'users') {
                $stubName = 'users_otp';
            }
            $this->files->put(
                $path = $this->getPath("create_{$name}_table",  base_path('database/migrations')),
                $this->getStub($stubName)
            );
            $this->info('Migration created successfully.');
        }
    }

    protected function checkCreated($name) {
        $filename = base_path('database/migrations/') . '*_create_' . $name . '_table.php';
        foreach (glob($filename) as $filefound) {
            return true;
        }
        return false;
    }

    protected function deleteDefaults() {
        if ($this->files->exists(base_path('database/migrations/2014_10_12_000000_create_users_table.php'))) {
            $this->files->delete(base_path('database/migrations/2014_10_12_000000_create_users_table.php'));
        }

        if ($this->files->exists(base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php'))) {
            $this->files->delete(base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php'));
        }
    }

    /**
     * @param $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getStub($name) {
        return $this->files->get(__DIR__."/stubs/migration.{$name}.stub");
    }

    /**
     * Get the full path to the migration.
     *
     * @param  string  $name
     * @param  string  $path
     * @return string
     */
    protected function getPath($name, $path)
    {
        return $path.'/'.$this->getTableName($name).'.php';
    }

    protected function getTableName($name) {
        return $this->getDatePrefix().'_'.$name;
    }

    /**
     * Get the date prefix for the migration.
     *
     * @return string
     */
    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['otp', 'o', InputOption::VALUE_OPTIONAL, 'Specified if an otp service is being used.'],
        ];
    }

}
