<?php 
namespace Neo\NepLocation\Factories\Api;

use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Repositories\AdministrativeAreaApiRepository;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class AdministrativeAreaRepositoryFactory implements AdministrativeAreaApiRepositoryFactoryInterface
{

    public function make(): AdministrativeAreaApiRepositoryInterface
    {
        $request = request();
        $dbType = request()->get('db_type', 'mysql');
        $version = $request->header('api-version', 'v1');

        // Versioned service selection
        return match ($dbType) {
            'mysql' => $this->mysql(),
            //'sql' => $this->sqlServer(),
        };
    }

    protected function mysql(): AdministrativeAreaApiRepositoryInterface
    {
        return new AdministrativeAreaApiRepository();
    }

    //protected function sqlServer(): AdministrativeAreaApiRepositoryInterface
    //{
    //    return new AdministrativeAreaApiSqlRepository();
    //}
}