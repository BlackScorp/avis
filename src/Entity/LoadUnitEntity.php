<?php


namespace BlackScorp\Avis\Entity;


class LoadUnitEntity
{
    private int $transportTypeId = 0;

    /**
     * LoadUnitEntity constructor.
     * @param int $transportTypeId
     */
    public function __construct(int $transportTypeId)
    {
        $this->transportTypeId = $transportTypeId;
    }

    public function getTransportTypeId():int{
        return $this->transportTypeId;
    }
}