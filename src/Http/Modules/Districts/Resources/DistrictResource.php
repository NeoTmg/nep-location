<?php

namespace Neo\NepLocation\Http\Modules\Districts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id
        ];
    }
}