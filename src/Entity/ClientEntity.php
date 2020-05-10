<?php


namespace BlackScorp\Avis\Entity;


class ClientEntity
{
    private string $orderId;

    /**
     * ClientEntity constructor.
     * @param $orderId
     */
    public function __construct(string $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }


}