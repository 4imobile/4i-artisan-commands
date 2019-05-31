<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Responses;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class CreateResponse extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:response';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom response class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Response';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $this->line("<info>Creating</info> " . $this->getNameInput());

        if ($this->option('standard')) {
            return __DIR__.'/stubs/response.standard.stub';
        }
        return __DIR__.'/stubs/response.plain.stub';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($this->rootNamespace().'Http\Responses\\'.$rawName);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Responses';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['standard', 's', InputOption::VALUE_NONE, 'Create the standard exception.'],
        ];
    }
}
