<?php

namespace Unit\App\Services\ListHandler;

use App\Services\ListHandler\AbstractListHandler;
use App\Services\ListHandler\FilterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\MockObject\MockObject;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;
use TestCase;

/**
 * Class AbstractListHandlerTest
 * @package Unit\App\Services\ListHandler
 */
class AbstractListHandlerTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function testGetList(): void
    {
        $lengthAwarePaginatorMock = $this->getLengthAwarePaginatorMock();
        $queryMock = $this->getQueryMock($lengthAwarePaginatorMock);
        $parameterBagMock = $this->getParameterBagMock();
        $filterMock = $this->getFilterMock($parameterBagMock, $queryMock);

        /** @var AbstractListHandler|MockObject $mock */
        $mock = $this->getMockForAbstractClass(AbstractListHandler::class);
        $mock->expects($this->once())
            ->method('getBasicQuery')
            ->willReturn($queryMock);


        $mock->addFilter($filterMock);
        $mock->getList($parameterBagMock);
    }

    /**
     * @param MockObject $lengthAwarePaginatorMock
     * @return MockObject|Builder
     */
    protected function getQueryMock(MockObject $lengthAwarePaginatorMock): MockObject
    {
        $mock = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())
            ->method('paginate')
            ->willReturn($lengthAwarePaginatorMock);

        return $mock;
    }

    /**
     * @param MockObject $parameterBagMock
     * @param MockObject $queryMock
     * @return MockObject|FilterInterface
     */
    protected function getFilterMock(MockObject $parameterBagMock, MockObject $queryMock): MockObject
    {
        $mock = $this->getMockBuilder(FilterInterface::class)->getMock();

        $mock->expects($this->once())
            ->method('filter')
            ->with($parameterBagMock, $queryMock);

        return $mock;
    }

    /**
     * @return MockObject|ParameterBag
     */
    protected function getParameterBagMock(): MockObject
    {
        $mock = $this->getMockBuilder(ParameterBag::class)->getMock();

        return $mock;
    }

    /**
     * @return MockObject|LengthAwarePaginator
     */
    protected function getLengthAwarePaginatorMock(): MockObject
    {
        $mock = $this->getMockBuilder(LengthAwarePaginator::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }
}
