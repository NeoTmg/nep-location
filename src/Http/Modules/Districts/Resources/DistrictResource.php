<?php

namespace Neo\NepLocation\Http\Modules\Districts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Neo\NepLocation\Http\Modules\States\Resources\StateResource;

class DistrictResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'province_name' => new StateResource($this->whenLoaded('province'))
        ];
    }
}