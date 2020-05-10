<?php


namespace BlackScorp\Avis\View;


use BlackScorp\Avis\Entity\LoadUnitEntity;

class LoadUnitView
{
    /**
     * @var TransportTypeView[]
     */
    public array $transportTypes = [];
    /**
     * LoadUnitView constructor.
     * @param LoadUnitEntity|mixed $loadUnit
     */
    public function __construct(LoadUnitEntity $loadUnit)
    {
    }

    public function addTransportType(TransportTypeView $transportTypeView)
    {
        $this->transportTypes[]=$transportTypeView;
    }
}