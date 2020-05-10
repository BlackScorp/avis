<?php


namespace BlackScorp\Avis\Repository;


use BlackScorp\Avis\Entity\ClientEntity;

interface ClientRepository
{

    /**
     * @param string $getOrderId
     * @return ClientEntity[]|[]
     */
    public function findByOrderId(string $getOrderId):array;
}