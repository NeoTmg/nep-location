<?php

namespace Neo\NepLocation\Providers;
 
use Illuminate\Contracts\Foundation\Application;
use Neo\NepLocation\Factories\Api\AdministrativeAreaServiceFactory;
use Neo\NepLocation\Factories\Api\AdministrativeAreaTypeServiceFactory;
use Neo\NepLocation\Factories\Api\DistrictServiceFactory;
use Neo\NepLocation\Factories\Api\StateServiceFactory;
use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaApiServiceFactoryInterface;
use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaTypeApiServiceFactoryInterface;
use Neo\NepLocation\Http\Contracts\Factories\DistrictApiServiceFactoryInterface;
use Neo\NepLocation\Http\Contracts\Factories\StateApiServiceFactoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiInterface;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiInterface;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiInterface;

class RestApiServiceBindingRegistrar
{
    /**
     * Register any application services.
     */
    public static function register(Application $app): void
    { 
        // Bind factory
        $app->bind(StateApiServiceFactoryInterface::class, StateServiceFactory::class);

        //binding interface
        $app->bind(StateApiInterface::class, fn ($app) => $app->make(StateApiServiceFactoryInterface::class)->make()
        );

        // Bind factory
        $app->bind(DistrictApiServiceFactoryInterface::class, DistrictServiceFactory::class);

        //binding interface
        $app->bind(DistrictApiInterface::class, fn ($app) => $app->make(DistrictApiServiceFactoryInterface::class)->make()
        );

        // Bind factory
        $app->bind(AdministrativeAreaTypeApiServiceFactoryInterface::class, AdministrativeAreaTypeServiceFactory::class);

        //binding interface
        $app->bind(AdministrativeAreaTypeApiInterface::class, fn ($app) => $app->make(AdministrativeAreaTypeApiServiceFactoryInterface::class)->make()
        );

        // Bind factory
        $app->bind(AdministrativeAreaApiServiceFactoryInterface::class, AdministrativeAreaServiceFactory::class);

        //binding interface
        $app->bind(AdministrativeAreaApiInterface::class, fn ($app) => $app->make(AdministrativeAreaApiServiceFactoryInterface::class)->make()
        );
    }
}
