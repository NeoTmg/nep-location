<?php

namespace Neo\NepLocation\Http\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ApiRepositoryInterface 
{
    /**
     * Get a paginated list of all resources.
     *
     * @param  array<string>  $columns
     */
    public function all(Request $request, array $columns = ['*']): LengthAwarePaginator;

    /**
     * Find a record matching the given conditions.
     *
     * @param  array<string, mixed>  $match
     * @param  array<string>  $columns
     * @return array<string, mixed>|null
     */
    public function find(array $match, array $columns = ['*']): ?array;

    /**
     * Create a new resource in the database.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): mixed;

    /**
     * Update a record matching the given conditions.
     *
     * @param  array<string, mixed>  $match
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function update(array $match, array $data): array;

    /**
     * Insert or update a record based on match condition.
     *
     * @param  array<string, mixed>  $match
     * @param  array<string, mixed>  $data
     */
    public function upsert(array $match, array $data): mixed;

    /**
     * Delete a record matching the given condition.
     *
     * @param  array<string, mixed>  $match
     */
    public function delete(array $match): bool;

    /**
     * Get the underlying Eloquent model instance.
     */
    public function getModel(): Model;
}
