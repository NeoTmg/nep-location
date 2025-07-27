<?php 
namespace Neo\NepLocation\Factories\Api;
  
use Illuminate\Http\Request;
use Neo\NepLocation\Exceptions\ApiVersionException;
use Neo\NepLocation\Http\Contracts\Factories\DistrictApiServiceFactoryInterface;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiInterface;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\Districts\DTOs\DistrictDto;
use Neo\NepLocation\Http\Modules\Districts\Resources\DistrictResource;
use Neo\NepLocation\Http\Modules\Districts\Services\DistrictApiService;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class DistrictServiceFactory implements DistrictApiServiceFactoryInterface
{

    public function __construct(
        protected Request $request,
        protected DistrictApiRepositoryInterface $repository,
    ) {}

    public function make(): DistrictApiInterface
    {
        $request = request();
        $version = $request->header('api-version', 'v1'); 

        // Versioned service selection
        return match ($version) {
            'v1' => $this->buildV1(), 
            default => throw new ApiVersionException,
        };
    }

    protected function buildV1(): DistrictApiInterface
    {
        $resource_case_type = request()->input('resource_case', 'default'); 

        $resource = $resource_case_type === 'snake'
            ? DistrictResource::class
            : DistrictResource::class;

        $dtoClass = match (true) {
            $this->request->isMethod('post') => DistrictDto::class,
            $this->request->isMethod('patch'),
            $this->request->isMethod('put') => DistrictDTO::class,
            default => DistrictDTO::class,
        };

        return new DistrictApiService($this->repository, $resource, $dtoClass);
    } 
} 