<?php


namespace BlackScorp\Avis\MessageStream;


use BlackScorp\Avis\View\LoadUnitView;

interface ListLoadUnitsMessageStream
{
    public function getOrderId():string;
    public function addLoadUnit(LoadUnitView $loadUnitView):void;
}