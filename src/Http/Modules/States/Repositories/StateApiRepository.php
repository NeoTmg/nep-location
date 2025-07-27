<?php

namespace Neo\NepLocation\Http\Modules\States\Repositories;
   
use Neo\NepLocation\Http\Modules\States\Contracts\StateApiRepositoryInterface;
use Neo\NepLocation\Http\Repositories\BaseApiRepository;
use Neo\NepLocation\Models\Province;

class StateApiRepository extends BaseApiRepository implements StateApiRepositoryInterface
{
    protected string $modelClass = Province::class;
}