<?php



$filename = 'data.txt';
//$file = fopen($filename, 'r');
//$lines = explode("\n", fread($file, filesize($filename)));
//
////print($lines);
//print_r($lines);


$file = new SplFileObject("data.txt");

function generator($file){
    while (!$file->eof()) {
        // Echo one line from the file.
        yield $file->fgets();
    }
}

foreach (generator($file) as $line)
{
    echo $line;
}



