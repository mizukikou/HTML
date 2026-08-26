<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST']; // = http://localhost
	header('Location: '.$uri.'/dashboard/'); // = http://localhost/dashboard
	exit;
?>
Something is wrong with the XAMPP installation :-(
