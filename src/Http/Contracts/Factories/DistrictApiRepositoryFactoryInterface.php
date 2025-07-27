<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\Districts\Contracts\DistrictApiRepositoryInterface;

/**
 * Interface DistrictServiceFactoryInterface
 * 
 */ 

interface DistrictApiRepositoryFactoryInterface
{
    public function make(): DistrictApiRepositoryInterface;
} 