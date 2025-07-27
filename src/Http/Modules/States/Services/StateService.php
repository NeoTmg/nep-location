<?php

namespace Neo\NepLocation\Http\Modules\States\Services;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Neo\NepLocation\Exceptions\ResourceExistException;
use Neo\NepLocation\Exceptions\ResourceNotFoundException;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiInterface;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiRepositoryInterface;
use Neo\NepLocation\Traits\ResponseTrait;

class StateApiService implements StateApiInterface
{
    use ResponseTrait;

    protected string $resourceClass;
    protected string $dtoClass;

    public function __construct(
        protected StateApiRepositoryInterface $repository,
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
            throw new ResourceNotFoundException('State', $id);
        }
        return $this->customSuccessResponse(new $this->resourceClass((object)$item));
    }

    public function store(mixed $request): JsonResponse
    {
        $dto = new ($this->dtoClass)($request->all());
        $payload = $dto->toArray();
        $existing = $this->repository->find(['id' => $payload['id']]);
        if ($existing) {
            throw new ResourceExistException('State', $payload['id']);
        }
        $item = $this->repository->create($payload);
        return $this->createdResponse($item, 'State Created Successfully.', $this->resourceClass);
    }

    public function update(int $id, mixed $request): JsonResponse
    {
        $dto = new ($this->dtoClass)($request->all());
        $payload = $dto->toArray();
        $payload['id'] = $id;
        $existing = $this->repository->find(['id' => $id]);
        if (!$existing) {
            throw new ResourceNotFoundException('State', $id);
        }
        $item = $this->repository->upsert(['id' => $id], $payload);
        return $this->updatedResponse($item, 'State Updated Successfully.', $this->resourceClass);
    }

    public function destroy(int $id): JsonResponse
    {
        $status = $this->repository->delete(['id' => $id]);
        if (!$status) {
            throw new ResourceNotFoundException('State', $id);
        }
        return $this->deletedResponse('State Deleted Successfully.');
    }
}