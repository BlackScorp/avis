<?php


namespace BlackScorp\Avis\MessageStream;


interface ListLoadUnitsMessageStream
{
    public function getOrderId():string;
    public function addLoadUnit():void;
}