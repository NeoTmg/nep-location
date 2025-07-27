<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\AdministrativeAreas\Contracts\AdministrativeAreaApiRepositoryInterface;

/**
 * Interface AdministrativeAreaServiceFactoryInterface
 * 
 */ 

interface AdministrativeAreaApiRepositoryFactoryInterface
{
    public function make(): AdministrativeAreaApiRepositoryInterface;
} 