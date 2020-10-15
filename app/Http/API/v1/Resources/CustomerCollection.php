<?php

namespace App\Http\API\v1\Resources;

use Raiadrogasil\Common\Resource\BaseCollection;
use Raiadrogasil\Common\Resource\BaseResource;

class CustomerCollection extends BaseCollection
{
    /**
     * @param $resource
     * @return CustomerResource
     * @codeCoverageIgnore
     */
    protected function resource($resource)
    {
        return new CustomerResource($resource);
    }


    public function configureMainParser()
    {
        $this->dataParser = [
            BaseResource::MAIN_NODE => $this->collection->map(
                function ($customer) {
                    $customerResource = $this->resource($customer);
                    return $customerResource->configureMainParser();
                }
            ),
        ];
        return $this;
    }
}
