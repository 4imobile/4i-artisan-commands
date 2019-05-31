<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Middleware;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CreateAllMiddleware extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:middlewares';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all custom middleware classes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Middleware';


    public function handle()
    {
        $this->createDeviceAuthenticate();
        $this->createUserAuthenticate();
    }

    protected function createDeviceAuthenticate() {
        $this->call('4i:device:auth:middleware', ['name' => 'DeviceAuthenticate']);
    }

    protected function createUserAuthenticate() {
        if ($this->option('otp')) {
            $this->call('4i:device:auth:middleware', [
                'name' => 'UserAuthenticate',
                '-o' => $this->option('otp')
            ]);
        } else {
            $this->call('4i:device:auth:middleware', ['name' => 'UserAuthenticate']);
        }

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
