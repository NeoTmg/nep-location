<?php 
namespace Neo\NepLocation\Factories\Api;

use Neo\NepLocation\Http\Contracts\Factories\StateApiRepositoryFactoryInterface;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\States\Repositories\StateApiRepository;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class StateRepositoryFactory implements StateApiRepositoryFactoryInterface
{

    public function make(): StateApiRepositoryInterface
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

    protected function mysql(): StateApiRepositoryInterface
    {
        return new StateApiRepository();
    }
 
}