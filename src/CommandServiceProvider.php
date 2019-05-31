<?php

namespace FourIMobile\FourIArtisanCommands;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Used to bind any classes or functionality into the app container.
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Used to boot any routes, event listeners, or any other functionality you want to add to your package.
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Device\Authentication\CreateDeviceAuthentication::class,
                Console\Device\Authentication\Configs\CreateAllConfigs::class,
                Console\Device\Authentication\Controllers\CreateController::class,
                Console\Device\Authentication\Exceptions\CreateAllExceptions::class,
                Console\Device\Authentication\Exceptions\CreateException::class,
                Console\Device\Authentication\Kernel\CreateKernel::class,
                Console\Device\Authentication\Middleware\CreateAllMiddleware::class,
                Console\Device\Authentication\Middleware\CreateMiddleware::class,
                Console\Device\Authentication\Migrations\CreateAllMigrations::class,
                Console\Device\Authentication\Models\CreateModel::class,
                Console\Device\Authentication\Responses\CreateAllResponses::class,
                Console\Device\Authentication\Responses\CreateResponse::class,
                Console\Device\Authentication\Routes\CreateAllRoutes::class,
                Console\Device\Authentication\Services\CreateService::class,
                Console\Device\Authentication\Routes\CreateDarude::class,
            ]);
        }
    }
}
