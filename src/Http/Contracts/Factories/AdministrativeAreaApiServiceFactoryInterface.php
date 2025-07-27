<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiInterface;

interface AdministrativeAreaApiServiceFactoryInterface
{
    public function make(): AdministrativeAreaApiInterface;
}
