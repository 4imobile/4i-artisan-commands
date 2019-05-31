<?php

namespace Rhaarhoff\fouriArtisanCommands\Console\Device\Authentication\Exceptions;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class CreateException extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth:exception';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom exception class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Exception';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $this->line("<info>Creating</info> " . $this->getNameInput());

        if ($this->option('auth')) {
            return __DIR__.'/stubs/exception.auth.stub';
        } elseif($this->option('nodevice')) {
            return __DIR__.'/stubs/exception.nodevice.stub';
        } elseif($this->option('security')) {
            return __DIR__.'/stubs/exception.security.stub';
        } elseif($this->option('validation')) {
            return __DIR__.'/stubs/exception.validation.stub';
        } elseif($this->option('otp')) {
            if ($this->option('otp') == 'twilio') {
                return __DIR__.'/stubs/exception.otp.twilio.stub';
            } elseif ($this->option('otp') == 'clickatel') {
                return __DIR__.'/stubs/exception.otp.clickatel.stub';
            }
        }

        return __DIR__.'/stubs/exception.plain.stub';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($this->rootNamespace().'Exceptions\\'.$rawName);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Exceptions';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['auth', 'a', InputOption::VALUE_NONE, 'Create the authorization exception.'],

            ['nodevice', 'd', InputOption::VALUE_NONE, 'Create the no device exception.'],

            ['plain', 'p', InputOption::VALUE_NONE, 'Create a the plain exception.'],

            ['security', 's', InputOption::VALUE_NONE, 'Create the security exception.'],

            ['validation', 'l', InputOption::VALUE_NONE, 'Create the validation exception.'],

            ['otp', 'o', InputOption::VALUE_REQUIRED, 'Create the otp exception.'],
        ];
    }
}
