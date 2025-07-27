<?php 
namespace Neo\NepLocation\Factories\Api;

use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaTypeApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Repositories\AdministrativeAreaTypeApiRepository;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class AdministrativeAreaTypeRepositoryFactory implements AdministrativeAreaTypeApiRepositoryFactoryInterface
{

    public function make(): AdministrativeAreaTypeApiRepositoryInterface
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

    protected function mysql(): AdministrativeAreaTypeApiRepositoryInterface
    {
        return new AdministrativeAreaTypeApiRepository();
    }

    //protected function sqlServer(): AdministrativeAreaTypeApiRepositoryInterface
    //{
    //    return new AdministrativeAreaTypeApiSqlRepository();
    //}
}