<?php

// Load general dependencies

// Load all classes from autoload dirs
$dirs = ['framework/'];

foreach($dirs as $dir)
{
	foreach(scandir($dir) as $file)
	{
		// Include sub dirs recursively unless they are underscored
		if(is_dir($file) && $file[0] != '_')
		{
			$dirs[] = $file;
			continue;
		}
		
		// Only include php scripts
		if('.php' == substr($file, -4))
			include($dir . $file);
	}
}

// Load app definition
include('app.php');