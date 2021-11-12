<?php


use app\fileStore\FileStore;


include __DIR__ . '/../../vendor/autoload.php';


$file = new FileStore('data.txt');


foreach ($file->generator() as $line)
{
    echo $line;
}

