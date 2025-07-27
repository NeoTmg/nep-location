<?php

namespace App\Http\Controllers\Api\AdministrativeAreas;

use App\Http\Controllers\Api\AdministrativeAreas\Contracts\AdministrativeAreaApiInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdministrativeAreaApiController
{
    public function __construct(protected AdministrativeAreaApiInterface $service) {}

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update(Request $request, int $id)
    {
        return $this->service->update($id, $request);
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}