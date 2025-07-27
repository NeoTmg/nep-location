<?php 
namespace Neo\NepLocation\Factories\Api;
 
use Illuminate\Http\Request;
use Neo\NepLocation\Exceptions\ApiVersionException;
use Neo\NepLocation\Http\Contracts\Factories\StateApiServiceFactoryInterface;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiInterface;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\States\DTOs\StateDto;
use Neo\NepLocation\Http\Modules\States\Resources\StateResource;
use Neo\NepLocation\Http\Modules\States\Services\StateApiService;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class StateServiceFactory implements StateApiServiceFactoryInterface
{

    public function __construct(
        protected Request $request,
        protected StateApiRepositoryInterface $repository,
    ) {}

    public function make(): StateApiInterface
    {
        $request = request();
        $version = $request->header('api-version', 'v1'); 

        // Versioned service selection
        return match ($version) {
            'v1' => $this->buildV1(), 
            default => throw new ApiVersionException,
        };
    }

    protected function buildV1(): StateApiInterface
    {
        $resource_case_type = request()->input('resource_case', 'default'); 

        $resource = $resource_case_type === 'snake'
            ? StateResource::class
            : StateResource::class;

        $dtoClass = match (true) {
            $this->request->isMethod('post') => StateDTO::class,
            $this->request->isMethod('patch'),
            $this->request->isMethod('put') => StateDTO::class,
            default => StateDto::class,
        };

        return new StateApiService($this->repository, $resource, $dtoClass);
    } 
} 