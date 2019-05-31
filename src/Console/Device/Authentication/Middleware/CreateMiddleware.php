<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Middleware;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class CreateMiddleware extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:middleware';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new middleware class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Middleware';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $this->line("<info>Creating</info> " . $this->getNameInput());

        if ($this->getNameInput() == 'DeviceAuthenticate') {
            return __DIR__.'/stubs/middleware.device.stub';
        } elseif($this->getNameInput() == 'UserAuthenticate') {
            if ($this->option('otp')) {
                return __DIR__.'/stubs/middleware.user.otp.stub';
            } else {
                return __DIR__.'/stubs/middleware.user.stub';
            }
        }
        return __DIR__.'/stubs/middleware.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Middleware';
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
