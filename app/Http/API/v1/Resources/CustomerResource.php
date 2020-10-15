<?php

namespace App\Http\API\v1\Resources;

use Raiadrogasil\Common\Resource\BaseResource;

class CustomerResource extends BaseResource
{
    public function configureNodeParser()
    {
        $this->dataParser = [
            BaseResource::MAIN_NODE => $this->resource
        ];

        return $this;
    }


    public function configureMainParser()
    {
        $this->dataParser = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cep' => $this->cep,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];

        return $this;
    }
}
