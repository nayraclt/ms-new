<?php

namespace App\Http\API\v1\Requests;

use App\Domain\DTO\CustomerDTO;
use Raiadrogasil\Common\Request\BaseRequest;

class CustomerRequest extends BaseRequest
{
    /**
     * Testa a validacao e retorna um DTO
     *
     * @return CustomerDTO
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateAdd()
    {
        //executar a validacao
        $rule = [
            'name' => 'required|max:50',
            'email' => 'required|max:50|email|unique:customer',
            'cep' => 'required|zipcode',
            'cpf' => 'required|cpf',

        ];
        $requestResource = $this->validateArr($rule, false);

        //parse para objeto DTO
        $customerDTO = new CustomerDTO($requestResource);

        return $customerDTO;
    }


    /**
     * Testa a validacao e retorna um DTO
     *
     * @return CustomerDTO
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateUpdate()
    {
        //executar a validacao
        $rule = [
            'name' => 'max:50',
            'email' => 'max:50|email|unique:customer',
            'cep' => 'zipcode',
            'cpf' => 'cpf',
        ];
        $requestResource = $this->validateArr($rule, true);

        //parse para objeto DTO
        $customerDTO = new CustomerDTO($requestResource);

        return $customerDTO;
    }



    /**
     * Validações customizadas atribuidas a esse modulo
     * @codeCoverageIgnore
     */
    public function buildValidationRulesCustom()
    {
    }
}
