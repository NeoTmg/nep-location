<?php 
namespace Neo\NepLocation\Factories\Api;

 
use Illuminate\Http\Request;
use Neo\NepLocation\Exceptions\ApiVersionException;
use Neo\NepLocation\Http\Contracts\Factories\AdministrativeAreaTypeApiServiceFactoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiRepositoryInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\DTOs\AdministrativeAreaTypeDto;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Resources\AdministrativeAreaTypeResource;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Services\AdministrativeAreaTypeApiService;

/**
 * Interface ApiDtoInterface
 *
 * Defines structure for API Data Transfer Object (DTO).
 */


class AdministrativeAreaTypeServiceFactory implements AdministrativeAreaTypeApiServiceFactoryInterface
{

    public function __construct(
        protected Request $request,
        protected AdministrativeAreaTypeApiRepositoryInterface $repository,
    ) {}

    public function make(): AdministrativeAreaTypeApiInterface
    {
        $request = request();
        $version = $request->header('api-version', 'v1'); 

        // Versioned service selection
        return match ($version) {
            'v1' => $this->buildV1(), 
            default => throw new ApiVersionException,
        };
    }

    protected function buildV1(): AdministrativeAreaTypeApiInterface
    {
        $resource_case_type = request()->input('resource_case', 'default'); 

        $resource = $resource_case_type === 'snake'
            ? AdministrativeAreaTypeResource::class
            : AdministrativeAreaTypeResource::class;

        $dtoClass = match (true) {
            $this->request->isMethod('post') => AdministrativeAreaTypeDto::class,
            $this->request->isMethod('patch'),
            $this->request->isMethod('put') => AdministrativeAreaTypeDTO::class,
            default => AdministrativeAreaTypeDTO::class,
        };

        return new AdministrativeAreaTypeApiService($this->repository, $resource, $dtoClass);
    } 
} 