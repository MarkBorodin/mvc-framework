<?php



$filename = 'data.txt';
$file = fopen($filename, 'r');
$lines = explode("\n", fread($file, filesize($filename)));

//print($lines);
print_r($lines);
