<?php

namespace BlackScorp\Test;

use BlackScorp\Avis\Entity\LoadUnitEntity;
use BlackScorp\Avis\Entity\TransportTypeEntity;
use BlackScorp\Avis\MessageStream\ListLoadUnitsMessageStream;
use BlackScorp\Avis\Repository\LoadUnitRepository;
use BlackScorp\Avis\Repository\TransportTypeRepository;
use BlackScorp\Avis\UseCase\ListLoadUnitsUseCase;
use PHPUnit\Framework\TestCase;

class ListLoadUnitsTest extends TestCase
{
    public function testListIsEmpty(){

        $messagesStream = $this->getMockBuilder(ListLoadUnitsMessageStream::class)->getMock();
        $messagesStream->expects($this->once())->method('getOrderId');

        $loadUnitRepository = $this->getMockBuilder(LoadUnitRepository::class)->getMock();
        $transportTypeRepository = $this->getMockBuilder(TransportTypeRepository::class)->getMock();

        $useCase = new ListLoadUnitsUseCase($loadUnitRepository,$transportTypeRepository);

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
            ->willReturn([new LoadUnitEntity(0)]);

        $transportTypeRepository = $this->getMockBuilder(TransportTypeRepository::class)->getMock();

        $useCase = new ListLoadUnitsUseCase($loadUnitRepository,$transportTypeRepository);

        $useCase->process($messagesStream);

        $this->assertCount(1,$loadUnits);
    }

    public function testTransportTypeIsSelected(){
        $loadUnits = [];
        $messagesStream = $this->getMockBuilder(ListLoadUnitsMessageStream::class)->getMock();
        $messagesStream->expects($this->once())->method('getOrderId');
        $messagesStream->expects($this->any())->method('addLoadUnit')
            ->willReturnCallback(function($loadUnit) use(&$loadUnits){
                $loadUnits[]=$loadUnit;
            });

        $loadUnitRepository = $this->getMockBuilder(LoadUnitRepository::class)->getMock();
        $loadUnitRepository->expects($this->once())->method('findByOrderId')
            ->willReturn([new LoadUnitEntity(0)]);

        $transportTypeRepository = $this->getMockBuilder(TransportTypeRepository::class)->getMock();
        $transportTypeRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([new TransportTypeEntity(0)]);
        $useCase = new ListLoadUnitsUseCase($loadUnitRepository,$transportTypeRepository);

        $useCase->process($messagesStream);

        $this->assertCount(1,$loadUnits);
        $this->assertCount(1,$loadUnits[0]->transportTypes);
        $this->assertTrue($loadUnits[0]->transportTypes[0]->isSelected);

    }
}
