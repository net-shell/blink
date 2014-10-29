<?php
class SaveAction extends ActionBase
{
	// Save passed configuration data to local storage
	public function Run($post)
	{
		$data = App::Get()->GetVar('cfg')->Settings;
		foreach(explode('&', $post['data']) as $prop)
		{
			$prop = explode('=', $prop);
			$prop[0] = urldecode($prop[0]);
			$prop[0] = explode('/', $prop[0]);
			$prop[1] = urldecode($prop[1]);
			$data->Template->{$prop[0][0]}->{$prop[0][1]}->v = $prop[1];
		}
		$this->SetConfigProperty('Settings', $data);
	}
	
	public function SetConfigProperty($property, $value)
	{
		$cfg = App::Get()->GetVar('cfg');
		$cfg->{'$property'} = $value;
		$result = json_encode($cfg);
		$cfgFile = App::Get()->GetVar('ConfigFile');
		$cfgFile = Environment::GetAppPath($cfgFile);
		if(!file_put_contents($cfgFile, $result))
			Error::Report('Can\'t write to config file', $result);
	}
}