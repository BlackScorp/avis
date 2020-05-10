<?php


namespace BlackScorp\Avis\Repository;


use BlackScorp\Avis\Entity\LoadUnitEntity;

interface LoadUnitRepository
{

    /**
     * @param string $getOrderId
     * @return LoadUnitEntity[]|[]
     */
    public function findByOrderId(string $getOrderId):array;
}