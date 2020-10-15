<?php

class CustomerServiceTest extends \Raiadrogasil\Test\BaseTestCase
{
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = Mockery::mock(\Illuminate\Http\Request::class);
    }

    protected function mockService($returnFindFirst, $isThrowException)
    {
        $returnDtoMock = Mockery::mock(\Raiadrogasil\Common\DTO\ReturnDTO::class)->makePartial();

        $repositoryMock = Mockery::mock(\App\Repositories\CustomerRepository::class)->makePartial();
        $repositoryMock->shouldReceive('where')->andReturn($repositoryMock);
        $repositoryMock->shouldReceive('first')->andReturn($returnFindFirst);
        $methodCreate = $repositoryMock->shouldReceive('addRegister')->andReturn($returnDtoMock);
        if ($isThrowException)
            $methodCreate->andThrow(new \Exception('NA'));
        $methodUpdate = $repositoryMock->shouldReceive('updateRegister')->andReturn($returnDtoMock);
        if ($isThrowException)
            $methodUpdate->andThrow(new \Exception('NA'));

        $serviceMock = Mockery::mock(\App\Services\CustomerService::class,[$repositoryMock])->makePartial();
        $serviceMock->shouldAllowMockingProtectedMethods()->shouldReceive('addRegister', 'updateRegister')->andReturn($returnDtoMock);

        return $serviceMock;
    }


    public function testRepository()
    {
        $return = $this->mockService(null, null)->repository();
        $this->assertInstanceOf(\Raiadrogasil\Common\Repository\BaseRepositoryInterface::class, $return);
    }

    public function testAdd()
    {
        $return = $this->mockService(null, null, null)->add(new \App\Domain\DTO\CustomerDTO(), $this->request);
        $this->assertInstanceOf(\Raiadrogasil\Common\DTO\ReturnDTO::class, $return);
    }

    public function testUpdate()
    {
        $updateData = new \App\Domain\DTO\CustomerDTO();
        $return = $this->mockService(null, null, null)->update(0, $updateData, $this->request);
        $this->assertInstanceOf(\Raiadrogasil\Common\DTO\ReturnDTO::class, $return);
    }
}
