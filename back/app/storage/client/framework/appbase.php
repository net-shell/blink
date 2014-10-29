<?php
class AppBase
{
	public $vars = array();
	
	public static function Get()
	{
		static $instance;
		if(null === $instance)
			$instance = new App();
		return $instance;
	}
	
	public function SetVar($k, $v)
	{
		$this->vars[$k] = $v;
	}
	
	public function GetVar($k)
	{
		return $this->vars[$k];
	}
	
	public function LoadConfigFile()
	{
		$file = $this->vars['ConfigFile'];
		$contents = Environment::GetAppPath($file);
		// var_dump($contents);
		$contents = file_get_contents($file);
		return $this->LoadConfigString($contents);
	}
	
	public function LoadConfigString($str)
	{
		$cfg = json_decode($str);
		if(!is_object($cfg))
			Error::Report('Error A601', $cfg);
		else
		{
			$this->SetVar('cfg', $cfg);
			return true;
		}
		return false;
	}
	
	public function GetConfigString()
	{
		return json_encode($this->GetVar('cfg'));
	}
}