<?php

namespace Modules\Iwallet\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iwallet\Listeners\RegisterIwalletSidebar;

class IwalletServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIwalletSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            // append translations
        });


    }

    public function boot()
    {
       
        $this->publishConfig('iwallet', 'config');
        $this->publishConfig('iwallet', 'crud-fields');

        $this->mergeConfigFrom($this->getModuleConfigFilePath('iwallet', 'settings'), "asgard.iwallet.settings");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('iwallet', 'settings-fields'), "asgard.iwallet.settings-fields");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('iwallet', 'permissions'), "asgard.iwallet.permissions");

        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iwallet\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Iwallet\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Iwallet\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iwallet\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iwallet\Repositories\TransactionRepository',
            function () {
                $repository = new \Modules\Iwallet\Repositories\Eloquent\EloquentTransactionRepository(new \Modules\Iwallet\Entities\Transaction());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iwallet\Repositories\Cache\CacheTransactionDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iwallet\Repositories\PocketRepository',
            function () {
                $repository = new \Modules\Iwallet\Repositories\Eloquent\EloquentPocketRepository(new \Modules\Iwallet\Entities\Pocket());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iwallet\Repositories\Cache\CachePocketDecorator($repository);
            }
        );
// add bindings



    }


}
