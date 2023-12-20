<?php
	session_start();
	require_once 'vendor/autoload.php'; // Include the Google API Client Library
	$client = new Google_Client();
	$client->setClientId('547958578018-gcaifq7me39ld7scoenrdpst1vd9l8ke.apps.googleusercontent.com');
	$client->setClientSecret('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');
	$client->setRedirectUri('https://www.socialfern.com/dashboard');
	$client->addScope('email');
	$client->addScope('profile');
	$client->addScope('https://www.googleapis.com/auth/youtube.readonly');
	$client->setDeveloperKey('AIzaSyDa9K5WTSNZ5uc8fi0aGL1hYl54TJb8_zY');
?>
