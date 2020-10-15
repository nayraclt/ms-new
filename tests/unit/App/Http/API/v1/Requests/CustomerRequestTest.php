<?php

class CustomerRequestTest extends \Raiadrogasil\Test\BaseTestCase
{
    use \Raiadrogasil\Test\Traits\TestRequest;

    public function requestClass()
    {
        return \App\Http\API\v1\Requests\CustomerRequest::class;
    }
}
