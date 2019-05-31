<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateService extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $this->line("<info>Creating</info> " . $this->getNameInput());

        if ($this->getNameInput() == 'UserService') {
            if ($this->option('otp')) {
                return __DIR__.'/stubs/service.user.otp.stub';
            } else {
                return __DIR__.'/stubs/service.user.stub';
            }
        } elseif($this->getNameInput() == 'TwilioService') {
            return __DIR__.'/stubs/service.twilio.stub';
        } elseif($this->getNameInput() == 'ClickatelService') {
            return __DIR__.'/stubs/service.clickatel.stub';
        }

        return __DIR__.'/stubs/service.plain.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Services';
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
