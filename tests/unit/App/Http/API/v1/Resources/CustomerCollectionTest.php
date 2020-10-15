<?php

class CustomerCollectionTest extends \Raiadrogasil\Test\BaseTestCase
{
    use \Raiadrogasil\Test\Traits\TestCollection;

    public function collectionClass()
    {
        return \App\Http\API\v1\Resources\CustomerCollection::class;
    }
}
