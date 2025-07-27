<?php

namespace Neo\NepLocation\Http\Modules\Districts\Repositories;
 
use Neo\NepLocation\Http\Contracts\BaseApiRepository;
use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiRepositoryInterface;
use Neo\NepLocation\Models\District;

class DistrictApiRepository extends BaseApiRepository implements DistrictApiRepositoryInterface
{
    protected string $modelClass = District::class;
}