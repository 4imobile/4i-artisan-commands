<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Routes;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateAllRoutes extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:auth:routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all custom routes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Routes';


    public function handle()
    {
        file_put_contents(
            base_path('routes/' . 'api.php'),
            '
Route::post(\'user/register\', \'UserController@register\');
            ',
            FILE_APPEND
        );

        if ($this->option('otp')) {
            file_put_contents(
                base_path('routes/' . 'api.php'),
                '
Route::post(\'user/otp\', \'UserController@requestOtp\');
            ',
                FILE_APPEND
            );
        }

        file_put_contents(
            base_path('routes/' . 'api.php'),
            '
Route::group([\'middleware\' => [\'auth.user\']], function() {
    Route::post(\'user/login\', \'UserController@login\');
});',
            FILE_APPEND
        );

        file_put_contents(
            base_path('routes/' . 'api.php'),
            '
Route::group([\'middleware\' => [\'auth.device\']], function() {
    // Add the routes requiring device authentication here
});',
            FILE_APPEND
        );

        $this->info('Routes created successfully.');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['otp', 'o', InputOption::VALUE_NONE, 'Specified if an otp service is being used.'],
        ];
    }

}
