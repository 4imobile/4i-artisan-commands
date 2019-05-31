<?php

namespace Rhaarhoff\fouriArtisanCommands\Console\Device\Authentication;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use InvalidArgumentException;

class CreateDeviceAuthentication extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the base authentication for devices';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $type = 'Controller';

    public function handle()
    {
        if ($this->option('all')) {
            if ($this->option('basic')) {
                $this->error('Can\'t generate basic & all authentication. Please select only one');
            } else {
                $this->input->setOption('migrations', true);
                $this->input->setOption('models', true);
                $this->input->setOption('controller', true);
                $this->input->setOption('service', true);
                $this->input->setOption('exceptions', true);

                if (!$this->option('otp')) {
                    $this->input->setOption('otp', 'twilio');
                    $this->input->setOption('config', true);
                }

                $this->input->setOption('middleware', true);
                $this->input->setOption('routes', true);
            }
        }

        if ($this->option('basic')) {
            if ($this->option('all')) {
                $this->error('Can\'t generate basic & all authentication. Please select only one');
            } else {
                $this->input->setOption('migrations', true);
                $this->input->setOption('models', true);
                $this->input->setOption('controller', true);
                $this->input->setOption('service', true);
                $this->input->setOption('exceptions', true);
                $this->input->setOption('middleware', true);
                $this->input->setOption('routes', true);
            }
        }

        if ($this->option('migrations')) {
            $this->createMigrations();
        }

        if ($this->option('models')) {
            sleep(1);
            $this->createModels();
        }

        sleep(1);
        $this->createResponses();

        if ($this->option('service')) {
            sleep(1);
            $this->createService();
        }

        if ($this->option('controller')) {
            sleep(1);
            if (!$this->option('service')) {
                $this->createController(false);
            } else {
                $this->createController(true);
            }
        }

        if ($this->option('exceptions')) {
            sleep(1);
            $this->createExceptions();
        }

        if ($this->option('config')) {
            sleep(1);
            $this->createConfigs();
        }

        if ($this->option('middleware')) {
            sleep(1);
            $this->createMiddleware();
        }

        if ($this->option('routes')) {
            sleep(1);
            $this->createRoutes();
        }
    }

    protected function createMigrations() {
        $this->info('Creating migrations...');
        if ($this->option('otp')) {
            $this->call('4i:auth:migrations', [
                '-o' => $this->option('otp')
            ]);
        } else {
            $this->call('4i:auth:migrations');
        }
    }

    protected function createModels() {
        $this->line('');
        $this->info('Creating Models...');

        if ($this->option('otp')) {
            $this->call('4i:auth:model', [
                'name' => 'User',
                '--force' => true,
                '-o' => $this->option('otp')
            ]);
        } else {
            $this->call('4i:auth:model', [
                'name' => 'User',
                '--force' => true
            ]);
        }

        $this->call('4i:auth:model', [
            'name' => 'Device',
            '--force' => true
        ]);
    }

    protected function createController($withService) {
        $this->line('');
        $this->info('Creating Controllers...');
        $controllerClass = $this->parseController('UserController');
        $baseClass = $this->parseController('BaseApiController');
        if (! class_exists($controllerClass)) {
            $this->call('4i:auth:controller', ['name' => basename($baseClass), '-b' => true]);
            if ($withService) {
                if ($this->option('otp')) {
                    $this->call('4i:auth:controller', [
                        'name' => basename($controllerClass),
                        '-o' => $this->option('otp')
                    ]);
                } else {
                    $this->call('4i:auth:controller', [
                        'name' => basename($controllerClass),
                        '-s' => true
                    ]);
                }

            } else {
                $this->call('4i:auth:controller', ['name' => basename($controllerClass)]);
            }
        } else {
            $this->error($controllerClass.' already exists!');
        }
    }

    protected function createService() {
        $this->line('');
        $this->info('Creating Services...');

        if ($this->option('otp')) {
            $class = 'TwilioService';
            if ($this->option('otp') == 'twilio') {
                $class = 'TwilioService';
            } elseif($this->option('otp') == 'clickatel') {
                $class = 'ClickatelService';
            }
            $this->call('4i:auth:service', [
                'name' => $class
            ]);

            $this->call('4i:auth:service', [
                'name' => 'UserService',
                '-o' => $this->option('otp')
            ]);
        } else {
            $this->call('4i:auth:service', [
                'name' => 'UserService'
            ]);
        }


    }

    protected function createResponses() {
        $this->line('');
        $this->info('Creating Responses...');

        if (!class_exists('StandardResponse')) {
            $this->call('4i:auth:response', ['name' => 'StandardResponse', '-s' => true]);
        }
    }

    protected function createConfigs() {
        $this->line('');
        $this->info('Updating Configs...');
        $this->call('4i:auth:configs', [
            '-o' => $this->option('otp')
        ]);
    }

    protected function createExceptions() {
        $this->line('');
        $this->info('Creating Exceptions...');

        $this->call('4i:auth:exceptions');
        if ($this->option('otp')) {
            if ($this->option('otp') == 'twilio') {
                $this->call('4i:auth:exception', [
                    'name' => 'TwilioAPIException',
                    '-o' => $this->option('otp')
                ]);
            } elseif ($this->option('otp') == 'clickatel') {
                $this->call('4i:auth:exception', [
                    'name' => 'ClickatelAPIException',
                    '-o' => $this->option('otp')
                ]);
            }
        }

    }

    protected function createMiddleware() {
        $this->line('');
        $this->info('Creating Middleware...');

        if ($this->option('otp')) {
            $this->call('4i:auth:middlewares', [
                '-o' => $this->option('otp')
            ]);
        } else {
            $this->call('4i:auth:middlewares');
        }
    }

    protected function createRoutes() {
        $this->line('');
        $this->line("<info>Updating</info> App\Kernel.php");
        $this->line(" - <info>Adding</info> auth.device <info>to route middleware</info>");
        $this->line(" - <info>Adding</info> auth.user <info>to route middleware</info>");

        $this->call('4i:auth:kernel', ['name' => 'Kernel', '--force' => true]);

        $this->line('');
        $this->line("<info>Updating</info> routes/api.php");

        if ($this->option('otp')) {
            $this->call('4i:auth:routes', [
                '-o' => $this->option('otp')
            ]);
        } else {
            $this->call('4i:auth:routes');
        }
    }

    /**
     * Get the fully-qualified controller class name.
     *
     * @param  string  $controller
     * @return string
     */
    protected function parseController($controller)
    {
        $controller = $this->valid($controller);
        if (! Str::startsWith($controller, $rootNamespace = $this->laravel->getNamespace())) {
            $controller = $rootNamespace.'Http\Controllers\\'.$controller;
        }

        return $controller;
    }

    /**
     * Get the fully-qualified service class name.
     *
     * @param  string  $controller
     * @return string
     */
    protected function parseService($service)
    {
        $service = $this->valid($service);
        if (! Str::startsWith($service, $rootNamespace = $this->laravel->getNamespace())) {
            $service = $rootNamespace.'Http\Services\\'.$service;
        }

        return $service;
    }

    protected function valid($name) {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $name)) {
            throw new InvalidArgumentException('Controller name contains invalid characters.');
        }

        $name = trim(str_replace('/', '\\', $name), '\\');

        return $name;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
//        if ($this->option('pivot')) {
//            return __DIR__.'/stubs/pivot.model.stub';
//        }

        return null;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a controller, service, middleware, otp, models and routes for authentication.'],

            ['basic', 'b', InputOption::VALUE_NONE, 'Generate a controller, service, middleware, models and routes for authentication.'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Generate a controller for authentication.'],

            ['service', 's', InputOption::VALUE_NONE, 'Generate a service for authentication.'],

            ['exceptions', 'e', InputOption::VALUE_NONE, 'Generate all exceptions and responses.'],

            ['otp', 'o', InputOption::VALUE_OPTIONAL, 'Generate an otp service.'],

            ['middleware', 'm', InputOption::VALUE_NONE, 'Generate authentication middleware.'],

            ['routes', 'r', InputOption::VALUE_NONE, 'Generate authentication routes.'],

            ['models', 'd', InputOption::VALUE_NONE, 'Generate authentication models.'],

            ['migrations', 'g', InputOption::VALUE_NONE, 'Generate migrations.'],

            ['config', 'f', InputOption::VALUE_NONE, 'Generate configs.'],
        ];
    }

}
