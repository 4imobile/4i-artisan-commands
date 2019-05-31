<?php

namespace Rhaarhoff\fouriArtisanCommands\Console\Device\Authentication\Exceptions;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CreateAllExceptions extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth:exceptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all custom exception classes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Exception';


    public function handle()
    {
        $this->createAuthenticationException();
        $this->createNoDeviceException();
        $this->createSecurityException();
        $this->createValidationException();
    }

    protected function createAuthenticationException() {
        $this->call('4i:auth:exception', ['name' => 'AuthorizationException', '-a' => true]);
    }

    protected function createNoDeviceException() {
        $this->call('4i:auth:exception', ['name' => 'NoDeviceException', '-d' => true]);
    }

    protected function createSecurityException() {
        $this->call('4i:auth:exception', ['name' => 'SecurityException', '-s' => true]);
    }

    protected function createValidationException() {
        $this->call('4i:auth:exception', ['name' => 'ValidationException', '-l' => true]);
    }

}
