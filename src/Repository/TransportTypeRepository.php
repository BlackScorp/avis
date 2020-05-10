<?php


namespace BlackScorp\Avis\Repository;


interface TransportTypeRepository
{

    /**
     * @return TransportTypeEntity[]
     */
    public function findAll():array;
}