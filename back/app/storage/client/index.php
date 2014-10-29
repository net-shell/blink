<?php
// Request handling script

$debug = true;
$view = 'ui';

// 1. Error handling
if($debug)
	require('debug.php');
else
{
	class Error { public static function Report(){ } }
}

// 2. Initialize app
// 2.1. Load dependencies
require('start.php');

// 2.3. Create app in memory
$app		= App::Get();
// opti: memcaching?

// 2.4. Load config and assign it to the app object
$app->LoadConfigFile();

// 3. Generate response

// 3.1. Respond to AJAX calls to back-end
if(isset($_GET['ajax']) && $_POST)
{
	require('start_back.php');
	GetAction($_POST['action'])->Run($_POST);
	exit;
}

// 3.2. Otherwise serve front-end UI
$app->Render('front/' . $view . '/main.php');