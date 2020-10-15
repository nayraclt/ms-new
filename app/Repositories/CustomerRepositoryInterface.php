<?php

namespace App\Repositories;

use Raiadrogasil\Common\Repository\BaseRepositoryInterface;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Busca um registro por seu ID ignorando se lancar exception
     *
     * @param $id
     * @param array $columns
     * @return mixed|void
     */
    public function findWithoutFail($id, $columns = ['*']);
}
