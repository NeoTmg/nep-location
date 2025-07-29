<?php

namespace Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdministrativeAreaTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}