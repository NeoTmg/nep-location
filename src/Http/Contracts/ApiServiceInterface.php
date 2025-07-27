<?php

namespace Neo\NepLocation\Http\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
  
interface ApiServiceInterface 
{
    /**
     * Get a paginated resource collection.
     */
    public function index(mixed $request): AnonymousResourceCollection;

    /**
     * Show a specific resource by ID.
     */
    public function show(int $id): JsonResponse;

    /**
     * Store a new resource.
     */
    public function store(mixed $request): JsonResponse;

    /**
     * Update an existing resource by ID.
     */
    public function update(int $id, mixed $request): JsonResponse;

    /**
     * Delete a resource by ID.
     */
    public function destroy(int $id): JsonResponse;
}
