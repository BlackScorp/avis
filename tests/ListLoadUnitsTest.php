<?php

namespace BlackScorp\Test;

use BlackScorp\Avis\Entity\LoadUnitEntity;
use BlackScorp\Avis\MessageStream\ListLoadUnitsMessageStream;
use BlackScorp\Avis\Repository\LoadUnitRepository;
use BlackScorp\Avis\UseCase\ListLoadUnitsUseCase;
use PHPUnit\Framework\TestCase;

class ListLoadUnitsTest extends TestCase
{
    public function testListIsEmpty(){

        $messagesStream = $this->getMockBuilder(ListLoadUnitsMessageStream::class)->getMock();
        $messagesStream->expects($this->once())->method('getOrderId');

        $loadUnitRepository = $this->getMockBuilder(LoadUnitRepository::class)->getMock();


        $useCase = new ListLoadUnitsUseCase($loadUnitRepository);

        $useCase->process($messagesStream);

        $this->doesNotPerformAssertions();
    }

    public function testShowOneEntry(){
        $loadUnits = [];
        $messagesStream = $this->getMockBuilder(ListLoadUnitsMessageStream::class)->getMock();
        $messagesStream->expects($this->once())->method('getOrderId');
        $messagesStream->expects($this->any())->method('addLoadUnit')
            ->willReturnCallback(function($loadUnit) use(&$loadUnits){
            $loadUnits[]=$loadUnit;
        });

        $loadUnitRepository = $this->getMockBuilder(LoadUnitRepository::class)->getMock();
        $loadUnitRepository->expects($this->once())->method('findByOrderId')
            ->willReturn([new LoadUnitEntity()]);

        $useCase = new ListLoadUnitsUseCase($loadUnitRepository);

        $useCase->process($messagesStream);

        $this->assertCount(1,$loadUnits);
    }
}
