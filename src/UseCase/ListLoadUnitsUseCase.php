<?php


namespace BlackScorp\Avis\UseCase;


use BlackScorp\Avis\MessageStream\ListLoadUnitsMessageStream;

class ListLoadUnitsUseCase
{


    public function process(ListLoadUnitsMessageStream $messagesStream)
    {
        $loadUnits = $messagesStream->getOrderId();
    }
}