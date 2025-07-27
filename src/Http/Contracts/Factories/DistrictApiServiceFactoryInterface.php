<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiInterface;

interface DistrictApiServiceFactoryInterface
{
    public function make(): DistrictApiInterface;
}
