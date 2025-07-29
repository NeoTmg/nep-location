<?php

namespace Neo\NepLocation\Http\Modules\Districts\Services;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Neo\NepLocation\Exceptions\ResourceExistException;
use Neo\NepLocation\Exceptions\ResourceNotFoundException;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiInterface;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiRepositoryInterface;
use Neo\NepLocation\traits\ResponseTrait;

class DistrictApiService implements DistrictApiInterface
{
    use ResponseTrait;

    protected string $resourceClass;
    protected string $dtoClass;

    public function __construct(
        protected DistrictApiRepositoryInterface $repository,
        string $resourceClass,
        string $dtoClass
    ) {
        $this->resourceClass = $resourceClass;
        $this->dtoClass = $dtoClass;
    }

    public function index(mixed $request): AnonymousResourceCollection
    {
        $items = $this->repository->all($request, ['*'], ['province']);
        return $this->successResponse($this->resourceClass::collection($items), $this->resourceClass);
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->repository->find(['id' => $id], ['*'] , ['province']);
        if (!$item) {
            throw new ResourceNotFoundException('District', $id);
        }
        return $this->customSuccessResponse(new $this->resourceClass((object)$item));
    }

    public function store(mixed $request): JsonResponse
    {
        $dto = new ($this->dtoClass)($request->all());
        $payload = $dto->toArray();
        $existing = $this->repository->find(['id' => $payload['id']]);
        if ($existing) {
            throw new ResourceExistException('District', $payload['id']);
        }
        $item = $this->repository->create($payload);
        return $this->createdResponse($item, 'District Created Successfully.', $this->resourceClass);
    }

    public function update(int $id, mixed $request): JsonResponse
    {
        $dto = new ($this->dtoClass)($request->all());
        $payload = $dto->toArray();
        $payload['id'] = $id;
        $existing = $this->repository->find(['id' => $id]);
        if (!$existing) {
            throw new ResourceNotFoundException('District', $id);
        }
        $item = $this->repository->upsert(['id' => $id], $payload);
        return $this->updatedResponse($item, 'District Updated Successfully.', $this->resourceClass);
    }

    public function destroy(int $id): JsonResponse
    {
        $status = $this->repository->delete(['id' => $id]);
        if (!$status) {
            throw new ResourceNotFoundException('District', $id);
        }
        return $this->deletedResponse('District Deleted Successfully.');
    }
}