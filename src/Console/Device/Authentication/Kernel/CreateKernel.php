<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Kernel;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class CreateKernel extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth:kernel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a basic kernel class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Kernel';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/kernel.basic.stub';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($this->rootNamespace().'Http\\'.$rawName);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the kernel already exists.'],

        ];
    }

}
