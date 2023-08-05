<?php

namespace CmXperts\MediaManager;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
//use LaravelBuilder\Facades\LaravelBuilder as LaravelBuilderFacade;
//use LaravelBuilder\TokenGuard;
//use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
//use Livewire\Livewire;

class CmXpertsMediaManagerServiceProvider extends ServiceProvider
{

    public function register()
    {
        // Register Resources
        $this->registerResource();
    }

    public function boot(Router $router, Dispatcher $event)
    {

        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }

    }

    /**
     * Register Package Resource.
     *
     * @return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../database/migrations'));
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cmxperts');
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::middleware('web')
            ->namespace('CmXperts\\MediaManager\\Http\\Controllers')
            ->group(function () {
                require __DIR__ . '/../routes/web.php';
            });
    }

    /**
     * Publish Package Resource.
     *
     * @return void
     */
    protected function publishResource()
    {
        // Publish Config File
        $this->publishes([
            __DIR__ . '/../config/cmx_media.php' => config_path('cmx_media.php'),
        ], 'cmx-media-config');
        // Publish View Files
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/cmxperts'),
        ], 'cmx-media-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'cmx-media-migrations');
        $this->publishes([
            __DIR__ . '/../payload/assets' => public_path('cmxperts/media/assets'),
        ], 'cmx-media-assets-files');
    }
}
