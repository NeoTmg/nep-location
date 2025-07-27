<?php

namespace Neo\NepLocation\Http\Modules\States;
 
use Illuminate\Http\Request;
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiInterface;

class StateApiController
{
    public function __construct(protected StateApiInterface $service) {}

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