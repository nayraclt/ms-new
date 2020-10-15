<?php

namespace App\Http\API\v1\Controllers;

use App\Http\Controllers\Controller;
use App\Http\API\v1\Resources\CustomerCollection;
use App\Http\API\v1\Resources\CustomerResource;
use App\Http\API\v1\Requests\CustomerRequest;
use App\Services\CustomerServiceInterface;
use Raiadrogasil\Common\Traits\RestActions;

class CustomerController extends Controller
{
    use RestActions;

    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @param $resource
     * @return CustomerCollection
     * @codeCoverageIgnore
     */
    protected function collection($resource)
    {
        return new CustomerCollection($resource, false);
    }

    /**
     * @param $resource
     * @return CustomerResource
     * @codeCoverageIgnore
     */
    protected function resource($resource)
    {
        return new CustomerResource($resource);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/customers",
     *     tags={"Customer v1"},
     *     summary="Listar todos os registros",
     *     description="Retorna multiplos registros assim como uma paginação",
     *     operationId="customer_all",
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso na operação"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro não encotrado"
     *     )
     * )
     */
    public function all(CustomerRequest $request)
    {
        try {
            $dataCustomer = $this->customerService->all($request);
        } catch (\Throwable $e) {
            throw $e;
        }

        $config = null;
        if (!empty($dataCustomer)) {
            $config = $this->collection($dataCustomer)
                ->configureMainParser();
        }

        return $this->response($config);
    }


    /**
     * @OA\Get(
     *     path="/api/v1/customers/{id}",
     *     tags={"Customer v1"},
     *     summary="Recuperar um registro pelo ID",
     *     description="Retona apenas um registro",
     *     operationId="customer_get",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do registro a ser buscado",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso na operação"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro não encontrado"
     *     )
     * )
     *
     * @param int $id
     */
    public function get($id, CustomerRequest $request)
    {
        $request->validateId($id);

        try {
            $dataCustomer = $this->customerService->get($id);
        } catch (\Throwable $e) {
            throw $e;
        }

        $config = null;
        if (!empty($dataCustomer)  && $dataCustomer->count()) {
            $config = $this->resource($dataCustomer)
                ->configureMainParser();
        }

        return $this->response($config);
    }


    /**
     * @OA\Post(
     *     path="/api/v1/customers",
     *     tags={"Customer v1"},
     *     summary="Incluir um registro",
     *     operationId="customer_add",
     *     @OA\Response(
     *         response=201,
     *         description="Sucesso na operação"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos na requisição"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação"
     *     ),
     *     @OA\RequestBody(
     *         description="Dados de entrada",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="name",
     *                     description="Nome do cliente",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="email",
     *                     description="Email do cliente",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cpf",
     *                     description="CPF do cliente",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="cep",
     *                     description="CEP do cliente",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function add(CustomerRequest $request)
    {
        $customerDTO = $request->validateAdd();

        try {
            $addCustomer = $this->customerService->add($customerDTO, $request);
        } catch (\Throwable $e) {
            throw $e;
        }

        return $this->response($addCustomer);
    }


    /**
     * @OA\Put(
     *     path="/api/v1/customers/{id}",
     *     tags={"Customer v1"},
     *     summary="Atualizar um registro existente",
     *     operationId="customer_update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do registro a ser atualizado",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso na operação"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro não encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos na requisição"
     *     ),
     *     @OA\RequestBody(
     *         description="Dados de entrada",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="name",
     *                     description="Nome do cliente",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="email",
     *                     description="Email do cliente",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cpf",
     *                     description="CPF do cliente",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="cep",
     *                     description="CEP do cliente",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function update($id, CustomerRequest $request)
    {
        $request->validateId($id);
        $customerDTO = $request->validateUpdate();

        try {
            $updateCustomer = $this->customerService->update($id, $customerDTO, $request);
        } catch (\Throwable $e) {
            throw $e;
        }

        return $this->response($updateCustomer);
    }
    

    /**
     * @OA\Delete(
     *     path="/api/v1/customers/{id}",
     *     tags={"Customer v1"},
     *     summary="Remover um registro",
     *     operationId="customer_remove",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do registro a ser removido",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso na operação"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro não encontrado"
     *     )
     * )
     */
    public function remove($id, CustomerRequest $request)
    {
        $request->validateId($id);

        try {
            $deleteCustomer = $this->customerService->remove($id, $request);
        } catch (\Throwable $e) {
            throw $e;
        }

        return $this->response($deleteCustomer);
    }
}
