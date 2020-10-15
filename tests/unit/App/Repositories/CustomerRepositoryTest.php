<?php

class CustomerRepositoryTest extends \Raiadrogasil\Test\BaseTestCase
{
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = Mockery::mock(\Illuminate\Http\Request::class);
        $this->request->request = [];
    }


    public function clsMockRepository()
    {
        $entity = Mockery::mock(\App\Domain\Entities\Customer::class)->makePartial();
        $parameterQueryBuilder = Mockery::mock(\Raiadrogasil\Common\Repository\QueryBuilder\ParameterQueryBuilder::class, [$this->request, $entity])->makePartial();
        $parameterQueryBuilder->shouldReceive('useCriteria', 'useOrderBy', 'usePaginate')->andReturn($parameterQueryBuilder);
        $parameterQueryBuilder->shouldReceive('get', 'find', 'skipPresenter', 'parserResult')->andReturn(collect([]));

        $mockRepository = Mockery::mock(\App\Repositories\CustomerRepository::class)->makePartial();
        $mockRepository->shouldAllowMockingProtectedMethods()->shouldReceive('queryBuilder')->andReturn($parameterQueryBuilder);
        $mockRepository->shouldReceive(['makeModel', 'makePresenter', 'makeValidator', 'boot'])->andReturn(true)->getMock();

        return $mockRepository;
    }


    public function testModel()
    {
        $result = $this->clsMockRepository()->model();
        $this->assertEquals(\App\Domain\Entities\Customer::class, $result);
    }
}
