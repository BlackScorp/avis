<?php


namespace BlackScorp\Avis\Entity;


class TransportTypeEntity
{
    private int $id = 0;

    /**
     * TransportTypeEntity constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}