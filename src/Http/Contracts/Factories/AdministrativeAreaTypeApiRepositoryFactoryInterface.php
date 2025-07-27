<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Contracts\AdministrativeAreaTypeApiRepositoryInterface;

/**
 * Interface AdministrativeAreaTypeServiceFactoryInterface
 * 
 */ 

interface AdministrativeAreaTypeApiRepositoryFactoryInterface
{
    public function make(): AdministrativeAreaTypeApiRepositoryInterface;
} 