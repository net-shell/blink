<?php

// Load back-end dependencies

// Back-end specific functions
function GetAction($action)
{
	// 1. Find action script
	$actionScript = 'back/' . strtolower($action) . '.php';
	if(!file_exists($actionScript)) Error::Report('Action script not found');
	
	// 2. Include action script
	$actionClass = ucfirst($action) . 'Action';
	require($actionScript);
	if(!class_exists($actionClass)) Error::Report('Controller class not defined in code file');
	
	// 3. Initialize action class
	return new $actionClass;
}