<?php

class CustomerControllerTest extends \Raiadrogasil\Test\BaseTestCase
{
    private $mockRequest;

    private $mockReturnDTO;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockInit();
    }

    protected function mockInit()
    {
        $this->mockRequest = \Mockery::mock(\App\Http\API\v1\Requests\CustomerRequest::class)->makePartial();
        $this->mockRequest->shouldAllowMockingProtectedMethods()->shouldReceive('validateStore', 'validateId', 'validateRequired', 'validateArr')->andReturn(true);
        $this->mockRequest->shouldReceive('validateUpdate', 'validateAdd')->andReturn(new \App\Domain\DTO\CustomerDTO());

        $this->mockReturnDTO = \Mockery::mock(\Raiadrogasil\Common\DTO\ReturnDTO::class)->makePartial();
        $this->mockReturnDTO->shouldReceive('count')->andReturn(1);
    }


    public function clsMockController($returnController, $returnService, $isThrowException)
    {
        $mockService = Mockery::mock(\App\Services\CustomerService::class)->makePartial();

        $methodAll = $mockService->shouldReceive('all')->andReturn($returnService);
        if ($isThrowException)
            $methodAll->andThrow(new \Exception('NA'));

        $methodGet = $mockService->shouldReceive('get')->andReturn($returnService);
        if ($isThrowException)
            $methodGet->andThrow(new \Exception('NA'));

        $methodAdd = $mockService->shouldReceive('add')->andReturn($returnService);
        if ($isThrowException)
            $methodAdd->andThrow(new \Exception('NA'));

        $methodAdd = $mockService->shouldReceive('update')->andReturn($returnService);
        if ($isThrowException)
            $methodAdd->andThrow(new \Exception('update'));

        $methodRemove = $mockService->shouldReceive('remove')->andReturn($returnService);
        if ($isThrowException)
            $methodRemove->andThrow(new \Exception('NA'));

        $fakeMock = \Mockery::mock('FakeMock')->shouldReceive('configureMainParser')->andReturn(true)->getMock();

        $mock = \Mockery::mock(\App\Http\API\v1\Controllers\CustomerController::class, [$mockService])->makePartial();
        $mock->shouldAllowMockingProtectedMethods()->shouldReceive('response')->andReturn($returnController)->getMock();
        $mock->shouldAllowMockingProtectedMethods()->shouldReceive('collection', 'resource')->andReturn($fakeMock)->getMock();
        return $mock;
    }


    public function getProvider()
    {
        $collection = collect(
            ['id' => 0],
            ['id' => 1]
        );

        return [
            'shouldTrueToException' => ['expectedValue' => false, 'arrParameters' => ['returnService' => false, 'isException' => true]],
            'shouldTrue' => ['expectedValue' => true, 'arrParameters' => ['returnService' => $collection, 'isException' => false]],
            'shouldFalseToReturnFalseInService' => ['expectedValue' => false, 'arrParameters' => ['returnService' => false, 'isException' => false]],
        ];
    }


    public function getProviderWithId()
    {
        return [
            'shouldTrueToException' => ['expectedValue' => false, 'arrParameters' => ['returnService' => true, 'isException' => true, 'id' => 1]],
            'shouldTrue' => ['expectedValue' => true, 'arrParameters' => ['returnService' => true, 'isException' => true, 'id' => 1]],
            'shouldFalseToReturnFalseInService' => ['expectedValue' => false, 'arrParameters' => ['returnService' => false, 'isException' => false, 'id' => 1]],
            'shouldFalseToIdFalse' => ['expectedValue' => false, 'arrParameters' => ['returnService' => true, 'isException' => false, 'id' => 0]],
        ];
    }


    /**
     * @dataProvider getProvider
     */
    public function testAll($expectedValue, $arrParameters)
    {
        $isException = $arrParameters['isException'];

        $returnService = collect(
            ['id' => 0],
            ['id' => 1]
        );

        if ($isException)
            $this->expectException(\Exception::class);

        $returnController = $expectedValue;
        $return = $this->clsMockController($returnController, $returnService, $isException)->all($this->mockRequest);

        $this->assertEquals($expectedValue, $return);
    }

    /**
     * @dataProvider getProviderWithId
     */
    public function testGet($expectedValue, $arrParameters)
    {
        $isException = $arrParameters['isException'];
        $id = $arrParameters['id'];
        $returnController = $expectedValue;
        $returnService = $this->mockReturnDTO;

        if ($isException)
            $this->expectException(\Exception::class);

        $return = $this->clsMockController($returnController, $returnService, $isException)->get($id, $this->mockRequest);

        $this->assertEquals($expectedValue, $return);
    }

    /**
     * @dataProvider getProvider
     */
    public function testAdd($expectedValue, $arrParameters)
    {
        $isException = $arrParameters['isException'];
        $returnController = $expectedValue;
        $returnService = $this->mockReturnDTO;

        if ($isException)
            $this->expectException(\Exception::class);

        $return = $this->clsMockController($returnController, $returnService, $isException)->add($this->mockRequest);

        $this->assertEquals($expectedValue, $return);
    }

    /**
     * @dataProvider getProviderWithId
     */
    public function testUpdate($expectedValue, $arrParameters)
    {
        $isException = $arrParameters['isException'];
        $returnController = $expectedValue;
        $returnService = $this->mockReturnDTO;
        $id = $arrParameters['id'];

        if ($isException)
            $this->expectException(\Exception::class);

        $return = $this->clsMockController($returnController, $returnService, $isException)->update($id, $this->mockRequest);

        $this->assertEquals($expectedValue, $return);
    }

    /**
     * @dataProvider getProviderWithId
     */
    public function testRemove($expectedValue, $arrParameters)
    {
        $isException = $arrParameters['isException'];
        $returnController = $expectedValue;
        $returnService = $this->mockReturnDTO;
        $id = $arrParameters['id'];

        if ($isException)
            $this->expectException(\Exception::class);

        $return = $this->clsMockController($returnController, $returnService, $isException)->remove($id, $this->mockRequest);

        $this->assertEquals($expectedValue, $return);
    }
}
