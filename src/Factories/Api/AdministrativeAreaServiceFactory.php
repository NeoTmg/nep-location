<?php 
namespace Neo\NepLocation\Factories\Api;

 
use Illuminate\Http\Request;
use Neo\NepLocation\Exceptions\ApiVersionException;
use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaApiServiceFactoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\DTOs\AdministrativeAreaDto;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Resources\AdministrativeAreaResource;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Services\AdministrativeAreaApiService;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class AdministrativeAreaServiceFactory implements AdministrativeAreaApiServiceFactoryInterface
{

    public function __construct(
        protected Request $request,
        protected AdministrativeAreaApiRepositoryInterface $repository,
    ) {}

    public function make(): AdministrativeAreaApiInterface
    {
        $request = request();
        $version = $request->header('api-version', 'v1'); 

        // Versioned service selection
        return match ($version) {
            'v1' => $this->buildV1(), 
            default => throw new ApiVersionException,
        };
    }

    protected function buildV1(): AdministrativeAreaApiInterface
    {
        $resource_case_type = request()->input('resource_case', 'default'); 

        $resource = $resource_case_type === 'snake'
            ? AdministrativeAreaResource::class
            : AdministrativeAreaResource::class;

        $dtoClass = match (true) {
            $this->request->isMethod('post') => AdministrativeAreaDto::class,
            $this->request->isMethod('patch'),
            $this->request->isMethod('put') => AdministrativeAreaDTO::class,
            default => AdministrativeAreaDTO::class,
        };

        return new AdministrativeAreaApiService($this->repository, $resource, $dtoClass);
    } 
} 