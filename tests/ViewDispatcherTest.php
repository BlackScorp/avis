<?php

namespace BlackScorp\Test;


use BlackScorp\Avis\Entity\ClientEntity;
use BlackScorp\Avis\MessageStream\ViewDispatcherMessageStream;
use BlackScorp\Avis\Repository\ClientRepository;
use BlackScorp\Avis\UseCase\ViewDispatcherUseCase;
use BlackScorp\Avis\View\ClientView;
use PHPUnit\Framework\TestCase;

class ViewDispatcherTest extends TestCase
{
    public function testClientExists(){
        /**
         * Arrange
         */
        $clientEntity = new ClientEntity('testOrder123');
        $clientEntities[]=$clientEntity;
        $clientRepository = $this->getMockBuilder(ClientRepository::class)->getMock();
        $clientRepository->expects($this->any())->method('findByOrderId')->willReturn($clientEntities);

        $useCase = new ViewDispatcherUseCase($clientRepository);
        /**
         * @var ClientView[]
         */
        $clients = [];
        $messageStream = $this->getMockBuilder(ViewDispatcherMessageStream::class)->getMock();
        $messageStream->expects($this->any())->method('addClient')
            ->willReturnCallback(function(ClientView $clientView) use(&$clients){
            $clients[]=$clientView;
            });

        /**
         * Act
         */
        $useCase->process($messageStream);

        /**
         * Assert
         */
        $this->assertCount(1,$clients);
    }

    public function testFirstClientIsSelected(){
        /**
         * Arrange
         */
        $clientEntity = new ClientEntity('testOderId');
        $clientEntities[]=$clientEntity;
        $clientRepository = $this->getMockBuilder(ClientRepository::class)->getMock();
        $clientRepository->expects($this->any())->method('findByOrderId')->willReturn($clientEntities);

        $useCase = new ViewDispatcherUseCase($clientRepository);
        /**
         * @var ClientView[]
         */
        $clients = [];
        $messageStream = $this->getMockBuilder(ViewDispatcherMessageStream::class)->getMock();
        $messageStream->expects($this->any())->method('addClient')
            ->willReturnCallback(function(ClientView $clientView) use(&$clients){
                $clients[]=$clientView;
            });
        $messageStream->expects($this->any())->method('getOrderId')->willReturn('testOderId');
        /**
         * Act
         */
        $useCase->process($messageStream);

        /**
         * Assert
         */
        $this->assertCount(1,$clients);
        $this->assertTrue($clients[0]->isSelected);
    }
}
