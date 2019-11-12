#!/usr/bin/php -q
<?php

$fd = fopen( "php://stdin", "r" );

$filename = "message.txt";
$message = "";

while ( !feof( $fd ) )
{
    $message .= fread( $fd, 1024 );
    file_put_contents($filename, $message);
}

fclose( $fd );

// The $message variable now holds the entire message text,
// which you can use for further processing.

?>