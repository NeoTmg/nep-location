<?php

namespace Neo\NepLocation\Providers;
 
use Illuminate\Contracts\Foundation\Application;
use Neo\NepLocation\Factories\Api\AdministrativeAreaRepositoryFactory;
use Neo\NepLocation\Factories\Api\AdministrativeAreaTypeRepositoryFactory;
use Neo\NepLocation\Factories\Api\DistrictRepositoryFactory;
use Neo\NepLocation\Factories\Api\StateRepositoryFactory;
use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaTypeApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Contracts\Factories\DistrictApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Contracts\Factories\StateApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiRepositoryInterface;

class RestApiRepositoryBindingRegistrar
{
    /**
     * Register any application services.
     */
    public static function register(Application $app): void
    {
        // Bind Repository Factory
        $app->bind(StateApiRepositoryFactoryInterface::class, StateRepositoryFactory::class);
        // Bind Api Repository Interface
        $app->bind(StateApiRepositoryInterface::class, fn ($app) => $app->make(StateApiRepositoryFactoryInterface::class)->make()
        );
        // Bind Repository Factory
        $app->bind(DistrictApiRepositoryFactoryInterface::class, DistrictRepositoryFactory::class);
        // Bind Api Repository Interface
        $app->bind(DistrictApiRepositoryInterface::class, fn ($app) => $app->make(DistrictApiRepositoryFactoryInterface::class)->make()
        );
        // Bind Repository Factory
        $app->bind(AdministrativeAreaTypeApiRepositoryFactoryInterface::class, AdministrativeAreaTypeRepositoryFactory::class);
        // Bind Api Repository Interface
        $app->bind(AdministrativeAreaTypeApiRepositoryInterface::class, fn ($app) => $app->make(AdministrativeAreaTypeApiRepositoryFactoryInterface::class)->make()
        );
        // Bind Repository Factory
        $app->bind(AdministrativeAreaApiRepositoryFactoryInterface::class, AdministrativeAreaRepositoryFactory::class);
        // Bind Api Repository Interface
        $app->bind(AdministrativeAreaApiRepositoryInterface::class, fn ($app) => $app->make(AdministrativeAreaApiRepositoryFactoryInterface::class)->make()
        );
    }
}
