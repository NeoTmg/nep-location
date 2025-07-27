<?php 
namespace Neo\NepLocation\Factories\Api;

use Neo\NepLocation\Http\Contracts\Factories\DistrictApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\Districts\Repositories\DistrictApiRepository;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class DistrictRepositoryFactory implements DistrictApiRepositoryFactoryInterface
{

    public function make(): DistrictApiRepositoryInterface
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

    protected function mysql(): DistrictApiRepositoryInterface
    {
        return new DistrictApiRepository();
    }

    //protected function sqlServer(): DistrictApiRepositoryInterface
    //{
    //    return new DistrictApiSqlRepository();
    //}
}