<?php


namespace BlackScorp\Avis\UseCase;


use BlackScorp\Avis\MessageStream\ListLoadUnitsMessageStream;
use BlackScorp\Avis\Repository\LoadUnitRepository;
use BlackScorp\Avis\View\LoadUnitView;

class ListLoadUnitsUseCase
{


    private LoadUnitRepository $loadUnitRepository;

    /**
     * ListLoadUnitsUseCase constructor.
     * @param LoadUnitRepository $loadUnitRepository
     */
    public function __construct(LoadUnitRepository $loadUnitRepository)
    {
        $this->loadUnitRepository = $loadUnitRepository;
    }

    public function process(ListLoadUnitsMessageStream $messagesStream)
    {
        $loadUnits = $this->loadUnitRepository->findByOrderId($messagesStream->getOrderId());

        foreach($loadUnits as $loadUnit){
            $loadUnitView = new LoadUnitView($loadUnit);
            $messagesStream->addLoadUnit($loadUnitView);
        }
    }
}