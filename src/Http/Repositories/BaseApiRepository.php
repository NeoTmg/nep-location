<?php

namespace Neo\NepLocation\Http\Repositories;

use Neo\NepLocation\Http\Contracts\ApiRepositoryInterface;

abstract class BaseApiRepository implements ApiRepositoryInterface
{
    /**
     * The model class name.
     *
     * @var class-string<Model>
     */
    protected string $modelClass;

    /**
     * Retrieve paginated resources with optional filters and sorting.
     *
     * @param  array<string>  $columns
     */
    public function all(mixed $request, array $columns = ['*']): LengthAwarePaginator
    {
        $request->per_page = $request->per_page ?? 20;
        $perPage = $request->per_page;

        return $this->getModel()
            ->when($request, function ($query) {
                return $query->filter()->sort();
            })
            ->select($columns)
            ->paginate($perPage);
    }

    /**
     * Find a single record by matching conditions.
     *
     * @param  array<string, mixed>  $match
     * @param  array<string>  $columns
     * @return array<string, mixed>|null
     */
    public function find(array $match, array $columns = ['*']): ?array
    {
        return $this->getModel()::where($match)->first($columns)?->toArray();
    }

    /**
     * Create a new record.
     *
     * @param  array<string, mixed>  $data
     * @return Model
     */
    public function create(array $data): mixed
    {
        return $this->getModel()::create($data);
    }

    /**
     * Update an existing record that matches the given conditions.
     *
     * @param  array<string, mixed>  $match
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function update(array $match, array $data): array
    {
        $record = $this->getModel()::where($match)->firstOrFail();
        $record->update($data);

        return $record->toArray();
    }

    /**
     * Insert or update a record based on matching fields.
     *
     * @param  array<string, mixed>  $match
     * @param  array<string, mixed>  $data
     * @return Model
     */
    public function upsert(array $match, array $data): mixed
    {
        return $this->getModel()::updateOrCreate(
            $match,
            $data
        );
    }

    /**
     * Delete a record by matching condition.
     *
     * @param  array<string, mixed>  $match
     */
    public function delete(array $match): bool
    {
        $record = $this->getModel()::where($match)->first();
        if (! $record) {
            return false;
        }

        return $record->delete();
    }

    /**
     * Resolve the model instance.
     */
    public function getModel(): Model
    {
        return app($this->modelClass);
    }
}
