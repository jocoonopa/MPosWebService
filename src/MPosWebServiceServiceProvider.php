<?php

namespace jocoonopa\MPosWebService;

use Illuminate\Support\ServiceProvider;
use Ixudra\Curl\CurlService;
use jocoonopa\MPosWebService\MPosWebService;

class MPosWebServiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/mpos-ws.php' => config_path('mpos-ws.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                \jocoonopa\MPosWebService\Console\Commands\MemberCount::class,
                \jocoonopa\MPosWebService\Console\Commands\MemberQuery::class,
                \jocoonopa\MPosWebService\Console\Commands\MemberFields::class,
                \jocoonopa\MPosWebService\Console\Commands\MemberAddressbook::class,
                \jocoonopa\MPosWebService\Console\Commands\DistrictList::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductCount::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductCountries::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductFields::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductGrapes::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductQuery::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductRegions::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductVersion::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductVintages::class,
                \jocoonopa\MPosWebService\Console\Commands\ProductWineTypes::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigurations();

        $this->app->singleton('mpos-ws', function ($app) {
            return new MPosWebService(new CurlService, config('mpos-ws'));
        });
    }

    public function provides()
    {
        return [
            'mpos-ws',
        ];
    }

    /**
     * Register the package configurations
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/mpos-ws.php'), 'mpos-ws'
        );
    }

    /**
     * Loads a path relative to the package base directory
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__, $path);
    }
}