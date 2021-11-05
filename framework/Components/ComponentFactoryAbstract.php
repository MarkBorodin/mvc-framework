<?php


namespace framework\Components;


abstract class ComponentFactoryAbstract
{
    public function createInstance()
    {
        return $this->getConcrete();
    }

    abstract protected function getConcrete();
}