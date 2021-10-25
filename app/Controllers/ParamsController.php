<?php

namespace app\Controllers;

class ParamsController
{
    public function index($args)
    {
        echo 'i am ParamsController<br>';
        foreach ($args as $key => $value){
            echo $key . " : " . $value . "<br>";
        }
    }
}