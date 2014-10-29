<?php

class Environment
{
	public static function FileWrite($file, $contents)
	{
		$file = self::GetFullPath($file);
		return file_put_contents($file, $contents);
	}
	
	public static function FileRead($file)
	{
		$file = self::GetFullPath($file);
		return file_get_contents($file);
	}
	
	public static function GetFullPath($file, $base = null)
	{
		if($base == null)
			$base = App::Get()->GetVar('EnvRootPath');
		
		if(substr($base, -1) !== '/')
			$base .= '/';
		
		if(substr($file, 0, strlen($base)) !== $base)
			$file = $base . $file;
		
		$real = realpath($file);
		if($real) $file = $real;
		
		return $file;
	}
	
	public static function GetAppPath($file)
	{
		$base = App::Get()->GetVar('AppRootPath');
		return self::GetFullPath($file, $base);
	}
}