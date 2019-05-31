<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Responses;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CreateAllResponses extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:device:auth:responses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all custom response classes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Response';


    public function handle()
    {
        $this->createStandardResponse();
    }

    protected function createStandardResponse() {
        $this->call('4i:device:auth:response', ['name' => 'StandardResponse', '-s' => true]);
    }

}
