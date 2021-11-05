<?php


namespace app\builder;


use framework\Components\ComponentFactoryAbstract;


class SqlBuilderFactory extends ComponentFactoryAbstract
{
    protected function getConcrete()
    {
        return new SqlBuilder();
    }
}