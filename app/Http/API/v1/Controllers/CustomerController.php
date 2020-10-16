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
     *     tags={"Cliente v1"},
     *     summary="Listar todos os clientes",
     *     description="Retorna multiplos clientes assim como uma paginação",
     *     operationId="customer_all",
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso na operação",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property="results",
     *                    type="array",
     *                    @OA\Items(
     *                         type="object",
     *                         @OA\Property(
     *                             property="id",
     *                             description="ID do cliente",
     *                             type="string",
     *                             example="5ec580976f7e83224741e392"
     *                         ),
     *                         @OA\Property(
     *                             property="name",
     *                             description="Nome do cliente",
     *                             type="string",
     *                             example="Nayra Lopes"
     *                         ),
     *                         @OA\Property(
     *                             property="email",
     *                             description="Email do cliente",
     *                             type="string",
     *                             example="nayra.c.teixeira@rd.com.br"
     *                         ),
     *                         @OA\Property(
     *                             property="cpf",
     *                             description="CPF do cliente",
     *                             type="integer",
     *                             example="00100100109"
     *                         ),
     *                         @OA\Property(
     *                             property="cep",
     *                             description="CEP do cliente",
     *                             type="integer",
     *                             example="70767540"
     *                         ),
     *                         @OA\Property(
     *                             property="createdAt",
     *                             description="Data de criação do cliente",
     *                             type="string",
     *                             example="2020-06-20T19:10:15.000000Z"
     *                         ),
     *                         @OA\Property(
     *                            property="updatedAt",
     *                            description="Data de atualizacao do cliente",
     *                            type="string",
     *                            example="2020-06-20T19:10:15.000000Z"
     *                         )
     *                    )
     *                 ),
     *                 @OA\Property(
     *                    property="metadata",
     *                    type="object",
     *                    @OA\Property(
     *                        property="limit",
     *                        description="Quantidade de clientes na paginacao",
     *                        type="integer",
     *                        example=15
     *                    ),
     *                     @OA\Property(
     *                        property="offset",
     *                        description="Inicio da paginacao",
     *                        type="integer",
     *                        example=0
     *                    ),
     *                     @OA\Property(
     *                        property="totalCount",
     *                        description="Quantidade de clientes",
     *                        type="integer",
     *                        example=1
     *                    ),
     *                     @OA\Property(
     *                        property="pages",
     *                        description="Paginas",
     *                        type="integer",
     *                        example=1
     *                    ),
     *                     @OA\Property(
     *                        property="links",
     *                        type="array",
     *                        @OA\Items(
     *                            type="object",
     *                            @OA\Property(
     *                                property="self",
     *                                description="Link da pagina atual",
     *                                type="string",
     *                                example="/api/v1/customers?limit=15&offset=0"
     *                            ),
     *                            @OA\Property(
     *                                property="first",
     *                                description="Link da primera pagina",
     *                                type="string",
     *                                example="/api/v1/customers?limit=15&offset=0"
     *                            ),
     *                            @OA\Property(
     *                                property="previous",
     *                                description="Link da pagina anterior",
     *                                type="string",
     *                                example=""
     *                            ),
     *                            @OA\Property(
     *                                property="next",
     *                                description="Link da proxima pagina",
     *                                type="string",
     *                                example="/api/v1/customers?limit=15&offset=15"
     *                            ),
     *                            @OA\Property(
     *                                property="last",
     *                                description="Link da ultima página",
     *                                type="string",
     *                                example="/api/v1/customers?limit=15&offset=11"
     *                            )
     *                        )
     *                    )
     *                 ),
     *                 @OA\Property(
     *                    property="traceId",
     *                    type="string",
     *                    description="Id da transação",
     *                    type="string",
     *                    example="7fa5fb8cad53cff1ff0149100d278ee3"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                      type="object",
     *                      @OA\Property(
     *                          property="message",
     *                          description="Mensagem retornada",
     *                          type="string",
     *                          example="Os dados fornecidos são inválidos"
     *                      ),
     *                      @OA\Property(
     *                         property="traceId",
     *                         type="string",
     *                         description="Id da transação",
     *                         type="string",
     *                         example="7fa5fb8cad53cff1ff0149100d278ee3"
     *                      ),
     *                      @OA\Property(
     *                         property="trace",
     *                         type="string",
     *                         description="Trace do problema",
     *                         type="string",
     *                         example=""
     *                      )
     *                  )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encotrado",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                      type="object",
     *                      @OA\Property(
     *                          property="message",
     *                          description="Mensagem retornada",
     *                          type="string",
     *                          example="Cliente não encontrado"
     *                      ),
     *                      @OA\Property(
     *                         property="traceId",
     *                         type="string",
     *                         description="Id da transacao",
     *                         type="string",
     *                         example="7fa5fb8cad53cff1ff0149100d278ee3"
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         description="Descrição do erro",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="trace",
     *                         type="string",
     *                         description="Trace do erro",
     *                         type="string",
     *                         example=""
     *                      )
     *                  )
     *         )
     *     )
     * )
     *
     * @param CustomerRequest $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Throwable
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
     *     tags={"Cliente v1"},
     *     summary="Recuperar um cliente pelo ID",
     *     description="Retona apenas um cliente",
     *     operationId="customer_get",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do cliente a ser buscado",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),@OA\Response(
     *         response=200,
     *         description="Sucesso na operação",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property="results",
     *                         type="object",
     *                         @OA\Property(
     *                             property="id",
     *                             description="ID do cliente",
     *                             type="string",
     *                             example="5ec580976f7e83224741e392"
     *                         ),
     *                         @OA\Property(
     *                             property="name",
     *                             description="Nome do cliente",
     *                             type="string",
     *                             example="Nayra Lopes"
     *                         ),
     *                         @OA\Property(
     *                             property="email",
     *                             description="Email do cliente",
     *                             type="string",
     *                             example="nayra@rd.com.br"
     *                         ),
     *                         @OA\Property(
     *                             property="cpf",
     *                             description="CPF do cliente",
     *                             type="integer",
     *                             example="00100100100"
     *                         ),
     *                         @OA\Property(
     *                             property="cep",
     *                             description="CEP do cliente",
     *                             type="integer",
     *                             example="70767540"
     *                         ),
     *                         @OA\Property(
     *                             property="createdAt",
     *                             description="Data de criação do cliente",
     *                             type="string",
     *                             example="2020-06-20T19:10:15.000000Z"
     *                         ),
     *                         @OA\Property(
     *                            property="updatedAt",
     *                            description="Data de atualizacao do cliente",
     *                            type="string",
     *                            example="2020-06-20T19:10:15.000000Z"
     *                         )
     *                 ),
     *                 @OA\Property(
     *                    property="traceId",
     *                    type="string",
     *                    description="Id da transacao",
     *                    type="string",
     *                    example="7fa5fb8cad53cff1ff322349100d278ee3"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valor inválido na operação",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                      type="object",
     *                      @OA\Property(
     *                          property="message",
     *                          description="Mensagem retornada",
     *                          type="string",
     *                          example="Os dados fornecidos são inválidos"
     *                      ),
     *                      @OA\Property(
     *                         property="traceId",
     *                         type="string",
     *                         description="Id da transacao",
     *                         type="string",
     *                         example="7fa5fb8cad53cff1ff0149100d278ee3"
     *                      ),
     *                      @OA\Property(
     *                         property="trace",
     *                         type="string",
     *                         description="Trace do problema",
     *                         type="string",
     *                         example=""
     *                      )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                      type="object",
     *                      @OA\Property(
     *                          property="message",
     *                          description="Mensagem retornada",
     *                          type="string",
     *                          example="Cliente não encontrado"
     *                      ),
     *                      @OA\Property(
     *                         property="traceId",
     *                         type="string",
     *                         description="Id da transacao",
     *                         type="string",
     *                         example="7fa5fb8cad53cff1ff0149100d278ee3"
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         description="Descrição do erro",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="trace",
     *                         type="string",
     *                         description="Trace do problema",
     *                         type="string",
     *                         example=""
     *                      )
     *             )
     *         )
     *     )
     * )
     *
     * @param int $id
     * @param CustomerRequest $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Throwable
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
     *     tags={"Cliente v1"},
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
     *     tags={"Cliente v1"},
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
     *     tags={"Cliente v1"},
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
