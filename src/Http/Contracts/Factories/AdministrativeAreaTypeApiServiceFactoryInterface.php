<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiInterface;

interface AdministrativeAreaTypeApiServiceFactoryInterface
{
    public function make(): AdministrativeAreaTypeApiInterface;
}
