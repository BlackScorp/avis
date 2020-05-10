<?php


namespace BlackScorp\Avis\MessageStream;


use BlackScorp\Avis\View\ClientView;

interface ViewDispatcherMessageStream
{
    public function addClient(ClientView $client):void;

    public function getOrderId():string ;
}