<?php

namespace Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Services;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Neo\NepLocation\Exceptions\ResourceExistException;
use Neo\NepLocation\Exceptions\ResourceNotFoundException;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiInterface;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiRepositoryInterface;
use Neo\NepLocation\traits\ResponseTrait;

class AdministrativeAreaTypeApiService implements AdministrativeAreaTypeApiInterface
{
    use ResponseTrait;

    protected string $resourceClass;
    protected string $dtoClass;

    public function __construct(
        protected AdministrativeAreaTypeApiRepositoryInterface $repository,
        string $resourceClass,
        string $dtoClass
    ) {
        $this->resourceClass = $resourceClass;
        $this->dtoClass = $dtoClass;
    }

    public function index(mixed $request): AnonymousResourceCollection
    {
        $items = $this->repository->all($request);
        return $this->successResponse($this->resourceClass::collection($items), $this->resourceClass);
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->repository->find(['id' => $id]);
        if (!$item) {
            throw new ResourceNotFoundException('AdministrativeAreaType', $id);
        }
        return $this->customSuccessResponse(new $this->resourceClass((object)$item));
    }

    public function store(mixed $request): JsonResponse
    {
        $dto = new ($this->dtoClass)($request->all());
        $payload = $dto->toArray();
        $existing = $this->repository->find(['id' => $payload['id']]);
        if ($existing) {
            throw new ResourceExistException('AdministrativeAreaType', $payload['id']);
        }
        $item = $this->repository->create($payload);
        return $this->createdResponse($item, 'AdministrativeAreaType Created Successfully.', $this->resourceClass);
    }

    public function update(int $id, mixed $request): JsonResponse
    {
        $dto = new ($this->dtoClass)($request->all());
        $payload = $dto->toArray();
        $payload['id'] = $id;
        $existing = $this->repository->find(['id' => $id]);
        if (!$existing) {
            throw new ResourceNotFoundException('AdministrativeAreaType', $id);
        }
        $item = $this->repository->upsert(['id' => $id], $payload);
        return $this->updatedResponse($item, 'AdministrativeAreaType Updated Successfully.', $this->resourceClass);
    }

    public function destroy(int $id): JsonResponse
    {
        $status = $this->repository->delete(['id' => $id]);
        if (!$status) {
            throw new ResourceNotFoundException('AdministrativeAreaType', $id);
        }
        return $this->deletedResponse('AdministrativeAreaType Deleted Successfully.');
    }
}