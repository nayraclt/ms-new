<?php

namespace App\Repositories;

use App\Domain\Entities\Customer;
use Raiadrogasil\Common\Repository\BaseRepository;

/**
 * Class CustomerRepository
 */
class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Customer::class;
    }
}
