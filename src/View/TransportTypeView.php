<?php


namespace BlackScorp\Avis\View;


class TransportTypeView
{
    public bool $isSelected = false;
    public function setActive()
    {
        $this->isSelected = true;
    }
}