<?php


namespace BlackScorp\Avis\UseCase;


use BlackScorp\Avis\MessageStream\ListLoadUnitsMessageStream;
use BlackScorp\Avis\Repository\LoadUnitRepository;
use BlackScorp\Avis\Repository\TransportTypeRepository;
use BlackScorp\Avis\View\LoadUnitView;
use BlackScorp\Avis\View\TransportTypeView;

class ListLoadUnitsUseCase
{


    private LoadUnitRepository $loadUnitRepository;
    private TransportTypeRepository $transportTypeRepository;

    /**
     * ListLoadUnitsUseCase constructor.
     * @param LoadUnitRepository $loadUnitRepository
     * @param TransportTypeRepository $transportTypeRepository
     */
    public function __construct(LoadUnitRepository $loadUnitRepository, TransportTypeRepository $transportTypeRepository)
    {
        $this->loadUnitRepository = $loadUnitRepository;
        $this->transportTypeRepository = $transportTypeRepository;
    }


    public function process(ListLoadUnitsMessageStream $messagesStream)
    {
        $loadUnits = $this->loadUnitRepository->findByOrderId($messagesStream->getOrderId());

        $transportTypes = $this->transportTypeRepository->findAll();



        foreach($loadUnits as $loadUnit){
            $loadUnitView = new LoadUnitView($loadUnit);

            foreach($transportTypes as $transportType){
                $transportTypeView = new TransportTypeView($transportType);
                if($transportType->getId() === $loadUnit->getTransportTypeId()){
                    $transportTypeView->setActive();
                }
                $loadUnitView->addTransportType($transportTypeView);
            }

            $messagesStream->addLoadUnit($loadUnitView);
        }
    }
}