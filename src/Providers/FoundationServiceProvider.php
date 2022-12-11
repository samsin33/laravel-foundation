<?php

namespace Samsin33\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Samsin33\Foundation\Console\Commands\FoundationModelMakeCommand;

class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerCommands();
    }

    /**
     * Register the Foundation Artisan commands.
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FoundationModelMakeCommand::class,
            ]);
        }
    }
}
