#!/usr/bin/php

$myfile = fopen("testfile.txt", "w");

fwrite($myfile,"hoot");

fclose($myfile);

