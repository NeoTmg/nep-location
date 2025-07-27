<?php

namespace Neo\NepLocation\Http\Modules\States\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id
        ];
    }
}