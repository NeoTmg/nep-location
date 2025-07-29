<?php

namespace Neo\NepLocation\Http\Modules\AdministrativeAreas\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Resources\AdministrativeAreaTypeResource;
use Neo\NepLocation\Http\Modules\Districts\Resources\DistrictResource;

class AdministrativeAreaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id, 
            'name' => $this->name, 
            'district' => new DistrictResource($this->whenLoaded('district')),
            'area_type' => new AdministrativeAreaTypeResource($this->whenLoaded('areaType'))
        ];
    }
}