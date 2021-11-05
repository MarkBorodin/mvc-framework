<?php

namespace app\builder;

class QueryResult
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getResult(): array
    {
        return $this->data;
    }
}