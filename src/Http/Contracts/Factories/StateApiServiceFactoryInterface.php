<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\States\Contracts\StateApiInterface;

interface StateApiServiceFactoryInterface
{
    public function make(): StateApiInterface;
}
