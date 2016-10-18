<?php
namespace Harrysbaraini\Loggable;

/**
 * Loggable
 *
 * Este pacote fornece modelo e eventos para logar alterações nos demais modelos.
 *
 * @author Vanderlei Sbaraini Amancio <vanderlei@citrus7.com.br>
 * @since 14/11/2016
 * @version 1.0
 * @copyright Harrysbaraini
 */

use Harrysbaraini\Loggable\Listeners\ModelLogger;
use Harrysbaraini\Loggable\Events\ModelWasCreated;
use Harrysbaraini\Loggable\Events\ModelWasUpdated;
use Harrysbaraini\Loggable\Events\ModelWasDeleted;
use Harrysbaraini\Loggable\Events\ModelWasRestored;

use App;
use Event;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class LoggableServiceProvider extends LaravelServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        $this->handleMigrations();

        if (!App::runningInConsole()) {
            $this->handleEvents();
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind any implementations.
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Handle configuration.
     *
     * @return void
     */
    private function handleConfigs()
    {

        $configPath = __DIR__ . '/../config/loggable.php';

        $this->publishes([$configPath => config_path('loggable.php')]);

        $this->mergeConfigFrom($configPath, 'loggable');
    }

    /**
     * Handle events.
     *
     * @return void
     */
    private function handleMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }

    private function handleEvents()
    {
        Event::listen(ModelWasCreated::class, ModelLogger::class);
        Event::listen(ModelWasUpdated::class, ModelLogger::class);
        Event::listen(ModelWasDeleted::class, ModelLogger::class);
        Event::listen(ModelWasRestored::class, ModelLogger::class);
    }
}
