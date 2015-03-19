<style>
body {
	background: black;
}
</style>

<?php
$uploadPath = "./upload";
$dh = opendir( $uploadPath );
if ( is_resource( $dh ) ) {
	while ( ( $file = readdir( $dh ) ) !== false ) {
		if ( $file != "." && $file != ".." ) {
			$fileList[] = $file;
		}
	}
}

asort( $fileList );

if ( isset( $_GET['cleanup'] ) ) {
	foreach ( $fileList as $file ) {
		unlink( $uploadPath . "/" . $file );
	}
	header( "Location: /camera/" );
}

$data = "";
foreach ( $fileList as $file ) {
	$data .= '<img src="' . $uploadPath . '/' . $file . '" />';
}
echo $data;
