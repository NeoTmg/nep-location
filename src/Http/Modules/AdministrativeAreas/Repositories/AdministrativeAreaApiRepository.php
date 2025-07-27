<?php

namespace Neo\NepLocation\Http\Modules\AdministrativeAreas\Repositories;

use Neo\NepLocation\Http\Contracts\BaseApiRepository;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiRepositoryInterface;
use Neo\NepLocation\Models\AdministrativeAreaName;

class AdministrativeAreaApiRepository extends BaseApiRepository implements AdministrativeAreaApiRepositoryInterface
{
    protected string $modelClass = AdministrativeAreaName::class;
}