<?php

namespace Neo\NepLocation\Http\Contracts\Factories;

use Neo\NepLocation\Http\Modules\States\Contracts\StateApiRepositoryInterface;

/**
 * Interface StateServiceFactoryInterface
 * 
 */ 

interface StateApiRepositoryFactoryInterface
{
    public function make(): StateApiRepositoryInterface;
} 