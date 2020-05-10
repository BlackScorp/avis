<?php


namespace BlackScorp\Avis\UseCase;


use BlackScorp\Avis\MessageStream\ViewDispatcherMessageStream;
use BlackScorp\Avis\Repository\ClientRepository;
use BlackScorp\Avis\View\ClientView;


class ViewDispatcherUseCase
{


    private ClientRepository $clientRepository;

    /**
     * ViewDispatcherUseCase constructor.
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function process(ViewDispatcherMessageStream $messageStream)
    {
        $clients = $this->clientRepository->findByOrderId($messageStream->getOrderId());

        foreach($clients as $client){
            $clientView = new ClientView($client);

            $messageStream->addClient($clientView);
        }
    }
}