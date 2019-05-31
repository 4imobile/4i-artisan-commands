<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Configs;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Log;
use Symfony\Component\Console\Input\InputOption;

class CreateAllConfigs extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:configs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all required configs';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Configs';

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

        $this->createConfig('services');
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createConfig($name) {
        Log::info($this->files->exists(base_path('config/services.php')));
        if ($this->files->exists(base_path('config/services.php'))) {
            $this->files->delete(base_path('config/services.php'));
        }
        $this->line(" - <info>Adding</info> {$this->option('otp')} <info>details to</info> config/{$name}.php");
        $this->files->put(
            $path = base_path("config/{$name}.php"),
            $this->getStub($name, $this->option('otp'))
        );
    }

    /**
     * @param $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getStub($name, $otp) {
        return $this->files->get(__DIR__."/stubs/{$name}.{$otp}.stub");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['otp', 'o', InputOption::VALUE_REQUIRED, 'Specified what otp service is being used.'],
        ];
    }

}
