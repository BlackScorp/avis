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

        $clientEntity = new ClientEntity();
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

        $useCase->process($messageStream);
        $this->assertCount(1,$clients);
    }
    public function testFirstClientIsSelected(){

    }
}
