<?php

namespace Rhaarhoff\fouriArtisanCommands\Console\Device\Authentication\Models;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateModel extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $this->line("<info>Creating</info> " . $this->getNameInput());

        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('migration', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $this->call('make:factory', [
            'name' => $this->argument('name').'Factory',
            '--model' => $this->argument('name'),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->getNameInput() == 'Device') {
            return __DIR__.'/stubs/model.device.stub';
        } elseif($this->getNameInput() == 'User' && !$this->option('otp')) {
            return __DIR__.'/stubs/model.user.stub';
        } elseif($this->getNameInput() == 'User' && $this->option('otp')) {
            return __DIR__.'/stubs/model.user.otp.stub';
        }

        return __DIR__.'/stubs/model.stub';
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
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, factory, and resource controller for the model'],

            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists.'],

            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],

            ['otp', 'o', InputOption::VALUE_NONE, 'Specified if an otp service is being used.'],

        ];
    }
}
