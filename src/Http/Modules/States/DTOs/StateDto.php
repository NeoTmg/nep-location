<?php

namespace Neo\NepLocation\Http\Modules\States\DTOs;

class StateDto
{ 
    protected array $data;

    public function __construct(array $input)
    {
        $validator = Validator::make($input, [
            //
            'customerID' => 'required|int',
            'firstName' => 'required',
            'lastName' => 'required',
            'customerType' => 'required',
            'clientCode' => 'required',
            'companyName' => 'required',
            'groupID' => 'required|int',
            'email' => 'string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $this->data = $validator->validated();
    }

    public function toArray(): array
    {
        return $this->data;
    }
}