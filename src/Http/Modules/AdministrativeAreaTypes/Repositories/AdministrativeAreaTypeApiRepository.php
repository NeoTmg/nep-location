<?php

namespace Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Repositories;
 
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiRepositoryInterface;
use Neo\NepLocation\Http\Repositories\BaseApiRepository;
use Neo\NepLocation\Models\AdministrativeAreaType;

class AdministrativeAreaTypeApiRepository extends BaseApiRepository implements AdministrativeAreaTypeApiRepositoryInterface
{
    protected string $modelClass = AdministrativeAreaType::class;
}