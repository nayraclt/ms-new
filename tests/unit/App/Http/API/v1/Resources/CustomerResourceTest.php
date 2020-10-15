<?php

class CustomerResourceTest extends \Raiadrogasil\Test\BaseTestCase
{
    use \Raiadrogasil\Test\Traits\TestResource;


    protected function arrayAttribute()
    {
        return [
            'id' => 1,
            'name' => '',
            'email' => '',
            'cpf' => 1,
            'cep' => 1,
            'created_at' => null,
            'updated_at' => null,
        ];
    }

    public function resourceClass()
    {
        return \App\Http\API\v1\Resources\CustomerResource::class;
    }
}
