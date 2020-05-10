<?php


namespace BlackScorp\Avis\View;


class ClientView
{
    public bool $isSelected = false;

    public function setActive():void
    {
        $this->isSelected = true;
    }
}