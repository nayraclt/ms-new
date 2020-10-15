<?php

namespace App\Domain\DTO;

use Raiadrogasil\Common\DTO\BaseDTO;
use Raiadrogasil\Common\DTO\BaseDTOInterface;

/**
 * @SuppressWarnings(PHPMD)
 *
 * Class CustomerDTO
 * @package App\Domain\DTO
 */
class CustomerDTO extends BaseDTO implements BaseDTOInterface
{
    private $id;

    private $name;

    private $email;

    private $cpf;

    private $cep;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCPF()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCPF($cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getCEP()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCEP($cep): void
    {
        $this->cep = $cep;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cep' => $this->cep,
        ];
    }
}
