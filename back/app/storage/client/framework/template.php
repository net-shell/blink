<?php

class Template
{
	public static $dirs = array('');
	
	public static function ListDir($dir, $filter)
	{
		$result = array();
		$files = scandir($dir);
		sort($files);
		
		foreach($files as $file)
		{
			if(substr($file, (-1 * strlen($filter))) == $filter)
				$result []= ($dir . $file);
		}
		
		return $result;
	}
	
	public static function Find($name)
	{	}
	
	/* Non-static members */
	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function Render()
	{
		require(Template::Find($this->name));
	}
}