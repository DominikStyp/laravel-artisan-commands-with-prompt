<?php

namespace DominikStyp\LaravelArtisanCommandsWithPrompt;

use Illuminate\Support\ServiceProvider;
class LaravelArtisanCommandsWithPromptServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
           __DIR__.'/publish/Console' => app_path('/Console')
        ]);
        $this->commands([
            \DominikStyp\LaravelArtisanCommandsWithPrompt\Console\Commands\CreateModel::class,
            \DominikStyp\LaravelArtisanCommandsWithPrompt\Console\Commands\Migrate::class,
        ]); 
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
    
}
