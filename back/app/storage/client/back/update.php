<?php
class UpdateAction extends ActionBase
{
	// Send local configuration to remote server and write respective changes from server response
	public function Run($data)
	{
		$url = App::Get()->GetVar('ApiEndpoint') . 'template/generate/';
		$url.= App::Get()->GetVar('TemplateID') . '/' . App::Get()->GetVar('EnvSystem');
		
		// Post config to server
		$fields_string = '';
		
		// Make sure we got the latest config
		$config = App::Get()->GetConfigString();
		$fields = array( 'config' => urlencode($config) );
		foreach($fields as $k=>$v)
			$fields_string .= $k . '=' . $v . '&';
		rtrim($fields_string, '&');
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		if(!(bool)$result) Error::Report('No config received', array($result));
		curl_close($ch);
		
		$resultData = json_decode($result);
		if(!(bool)$resultData) Error::Report('Received config failed to decode', array($url, $result));
		$result = $resultData;
		
		GetAction('save')->SetConfigProperty('APIKey', $result->APIKey);
		
		$files = (array)$result->Files;
		if(!$files) Error::Report('Received config does not contain results', array($result));
		if(count($files) < 1) Error::Report('No files received');
		
		// Output to system template folder
		$outDir = App::Get()->GetVar('EnvTemplatePath') . $result->Dir . '/';
		if(!$this->MakeDir($outDir))
			$this->RemoveDir($outDir);
		
		// Write each file
		foreach($files as $name=>$content)
		{
			// Check/build file path
			$path = explode('/', $name);
			if(count($path) > 1)
			{
				$cpath = $outDir;
				for($i=0; $i < count($path) - 1; $i--)
				{
					$cpath.= $path[$i] . '/';
					if(!file_exists($cpath)) $this->MakeDir($cpath);
				}
			}
			
			Environment::FileWrite($outDir.$name, $content);	
		}
		
		// Set the site theme
		$fn = 'SetTheme' . App::Get()->GetVar('EnvSystem');
		$this->$fn($result->Dir);
	}
}