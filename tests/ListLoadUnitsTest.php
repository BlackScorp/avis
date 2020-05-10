<?php

namespace BlackScorp\Test;

use BlackScorp\Avis\MessageStream\ListLoadUnitsMessageStream;
use BlackScorp\Avis\UseCase\ListLoadUnitsUseCase;
use PHPUnit\Framework\TestCase;

class ListLoadUnitsTest extends TestCase
{
    public function testListIsEmpty(){

        $messagesStream = $this->getMockBuilder(ListLoadUnitsMessageStream::class)->getMock();
        $messagesStream->expects($this->once())->method('getOrderId');
        $useCase = new ListLoadUnitsUseCase();

        $useCase->process($messagesStream);

        $this->doesNotPerformAssertions();
    }

    public function testShowOneEntry(){
        $loadUnits = [];
        $messagesStream = $this->getMockBuilder(ListLoadUnitsMessageStream::class)->getMock();
        $messagesStream->expects($this->once())->method('getOrderId');
        $messagesStream->expects($this->any())->method('addLoadUnit')->willReturnCallback(function($loadUnit) use(&$loadUnits){
            $loadUnits[]=$loadUnit;
        });
        $useCase = new ListLoadUnitsUseCase();

        $useCase->process($messagesStream);

        $this->assertCount(1,$loadUnits);
    }
}
