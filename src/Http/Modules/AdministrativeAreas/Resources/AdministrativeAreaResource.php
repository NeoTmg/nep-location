<?php

namespace Neo\NepLocation\Http\Modules\AdministrativeAreas\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdministrativeAreaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id
        ];
    }
}