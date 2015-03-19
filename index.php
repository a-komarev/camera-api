<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<title>WebCamera | SandBox</title>
	<meta name="author" content="Pe Ell" />
</head>
<body>
	<table>
		<tr>
			<td valign="top">
				<h1>Live preview</h1>

				<!-- First, include the JPEGCam JavaScript Library -->
				<script type="text/javascript" src="webcam.js"></script>
				
				<!-- Configure a few settings -->
				<script language="JavaScript">
					webcam.set_api_url( "record.php" );
					webcam.set_quality( 100 ); // JPEG quality (1 - 100)
					webcam.set_shutter_sound( false ); // Play shutter click sound
				</script>
				
				<!-- Next, write the movie to the page at 320x240 -->
				<script language="JavaScript">
					document.write( webcam.get_html( 320, 240 ) );
					// document.write( webcam.get_html( 640, 480 ) );
					// document.write( webcam.get_html( 240, 120 ) );
				</script>
				
				<!-- Some buttons for controlling things -->
				<footer>
					<form>
						<input type="button" value="Настройки веб-камеры" onClick="webcam.configure()" />
						<input type="button" value="Сделать снимок" onClick="take_snapshot()" />
					</form>
				</footer>
			</td>
			<td valign="top">
				<div id="upload_results" style="background-color:#eee;"></div>
			</td>
		</tr>
	</table>

	<!-- Code to handle the server response (see test.php) -->
	<script>
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function take_snapshot() {
			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
			console.log('snapshotted');
		}
		
		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if ( msg.match(/(http\:\/\/\S+)/) ) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML = 
					'<h1>Upload Successful!</h1>' + 
					'<h3>JPEG URL: ' + image_url + '</h3>' + 
					'<img src="' + image_url + '">';
				
				// reset camera for another shot
				webcam.reset();
			}
			else alert( "PHP Error: " + msg );
		}
		
		/*
		setInterval(function() {
			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
			console.log('snapshotted');
		}, 10000);
		*/
	</script>
</body>
</html>
