<?php

class ActionBase
{
	public function MakeDir($dir)
	{
		$dir = Environment::GetFullPath($dir);
		return @mkdir($dir);
	}
	
	public function RemoveDir($dir)
	{
		if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')
			return exec("rm -rf $dir");
		
		foreach(glob($dir . '/*') as $file)
		{ 
			if(is_dir($file)) rmrf($file);
			else unlink($file); 
		}
	}

	function SetThemeWP($theme)
	{
		$file = Environment::GetFullPath('wp-load.php');
		include($file);
		switch_theme($theme);
	}
}