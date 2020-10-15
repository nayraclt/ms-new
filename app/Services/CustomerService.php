<?php

namespace App\Services;

use Illuminate\Http\Request;
use Raiadrogasil\Common\Repository\BaseRepositoryInterface;
use Raiadrogasil\Common\Service\BaseService;
use Raiadrogasil\Common\Exceptions\CustomFailException;
use Raiadrogasil\Common\DTO\ReturnDTO;
use App\Domain\DTO\CustomerDTO;
use App\Repositories\CustomerRepositoryInterface;

class CustomerService extends BaseService implements CustomerServiceInterface
{
    /**
     * @var customerRepositoryInterface
     */
    private $customerRepository;


    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Retorna o repositorio
     *
     * @return BaseRepositoryInterface|null
     */
    public function repository(): ?BaseRepositoryInterface
    {
        return $this->customerRepository;
    }


    /**
     * Adicionar um registro
     *
     * @param CustomerDTO $customerDTO
     * @param Request $request
     * @return ReturnDTO
     */
    public function add(CustomerDTO $customerDTO, Request $request): ReturnDTO
    {
        return $this->addRegister($customerDTO, $request);
    }


    /**
     * Atualizar o registro
     *
     * @param int $id
     * @param CustomerDTO $customerDTO
     * @param Request $request
     * @return ReturnDTO
     */
    public function update(int $id, CustomerDTO $customerDTO, Request $request): ReturnDTO
    {
        return $this->updateRegister($id, $customerDTO, $request);
    }
}
