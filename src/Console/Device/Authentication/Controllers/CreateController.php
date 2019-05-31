<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateController extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new authentication controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('service')) {
            return __DIR__.'/stubs/controller.service.stub';
        } elseif($this->option('base')) {
            return __DIR__.'/stubs/controller.base.stub';
        } elseif($this->option('otp')) {
            return __DIR__.'/stubs/controller.service.otp.stub';
        }
        return __DIR__.'/stubs/controller.plain.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $this->line("<info>Creating</info> " . $this->getNameInput());

        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('service')) {
            $replace = $this->buildServiceReplacements($replace);
        }

        if ($this->option('base')) {
            $replace = $this->buildBaseReplacements($replace);
        }

        if ($this->option('otp')) {
            $replace = $this->buildOtpReplacements($replace);
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }


    /**
     * Build the service replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildServiceReplacements(array $replace)
    {
//        return array_merge($replace, [
//            'DummyFullModelClass' => $modelClass,
//            'DummyModelClass' => class_basename($modelClass),
//            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
//        ]);
        return null;
    }

    /**
     * Build the base replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildBaseReplacements(array $replace)
    {
        $baseClass = $this->parseBaseController('BaseApiController');
        return array_merge($replace, [
            'DummyClass' => class_basename($baseClass),
        ]);
    }

    protected function buildOtpReplacements(array $replace)
    {
        $otpServiceClass = 'TwilioService';
        $otpServiceVariable = 'twilioService';
        if ($this->option('otp') == 'clickatel') {
            $otpServiceClass = 'ClickatelService';
            $otpServiceVariable = 'clickatelService';
        }
        return array_merge($replace, [
            'OtpServiceClass' => $otpServiceClass,
            'OtpServiceVariable' => $otpServiceVariable,
        ]);
    }

    /**
     * Get the fully-qualified controller class name.
     *
     * @param  string  $controller
     * @return string
     */
    protected function parseBaseController($controller)
    {
        $controller = $this->valid($controller);
        if (! Str::startsWith($controller, $rootNamespace = $this->laravel->getNamespace())) {
            $controller = $rootNamespace.'Http\Controllers\\'.$controller;
        }

        return $controller;
    }

    protected function valid($name) {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $name)) {
            throw new InvalidArgumentException('Controller name contains invalid characters.');
        }

        $name = trim(str_replace('/', '\\', $name), '\\');

        return $name;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['service', 's', InputOption::VALUE_NONE, 'Specifies that a service was created.'],

            ['base', 'b', InputOption::VALUE_NONE, 'Specifies that a base controller should be created.'],

            ['otp', 'o', InputOption::VALUE_OPTIONAL, 'Specifies the otp service.'],
        ];
    }

}
