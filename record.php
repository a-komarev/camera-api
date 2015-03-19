<?php

/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */

$filename = date( "y-m-d-H-i-s" ) . '.jpg';
$uploadPath = 'upload/' . $filename;
$buffer = file_get_contents( 'php://input' );
$result = file_put_contents( $uploadPath, $buffer );
if ( ! $result ) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname( $_SERVER['REQUEST_URI'] ) . '/upload/' . $filename;
print "$url\n";

?>
