<?php

class App extends AppBase
{
	public $vars = array();
	
	public function __construct()
	{
		// Engine defines
		$this->vars['EnvSystem']		= 'wp';
		$this->vars['EnvRootPath']		= realpath(__DIR__ . '/..') . '/';
		$this->vars['AppRootPath']		= __DIR__ . '/';

		$this->vars['ApiServer']		= 'http://localhost/index.php/';
		$this->vars['ApiEndpoint']		= $this->vars['ApiServer'] . 'api/';
		$this->vars['TemplateID']		= 6;
		$this->vars['ConfigFile']		= 'configuration.json';

		// Environment-specific initializations
		$esPlatform = strtolower($this->vars['EnvSystem']);
		
		$esStartFile	= 'start/' . $esPlatform . '.php';
		if(!file_exists($esStartFile)) Error::Report('Can\'t find environment-specific start file');
		$esStartClass	= ucfirst($esPlatform) . 'Start';
		require($esStartFile);
		call_user_func_array(array($esStartClass, 'Init'), array($this));
		
		$this->vars['EnvTemplatePath']	= $this->vars['envTplPath'];

		// Client environment vars
		$this->vars['ClientBase'] = explode('/', $_SERVER['REQUEST_URI']);
		$uiDftOpen = true;

		for($i=1; $i<=2; $i++)
			array_pop($this->vars['ClientBase']);

		$this->vars['ClientBase']		= implode('/', $this->vars['ClientBase']) . '/';
		$this->vars['ClientBaseUrl']	= 'http' . ($_SERVER['HTTPS'] == 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'];
		$this->vars['ClientSelfUrl']	= $this->vars['ClientBaseUrl'] . $_SERVER['REQUEST_URI'];
		$this->vars['ClientAjaxUrl']	= $this->vars['ClientSelfUrl'] . '?ajax';

		$this->vars['AssetsUrl']		= $this->vars['ClientSelfUrl'] . 'front/';

		// Prerequisites

		$pre = array();
		$pre['allow_fopen'] = ini_get('allow_url_fopen');
		$pre['config_write'] = is_writable($this->vars['ConfigFile']);
		foreach($pre as $k=>$v)
			if(!(bool)$v) die('Requirement ' . $k . ' not met!');
	}
	
	public function Render($file)
	{
		$file = Environment::GetAppPath($file);
		if(!file_exists($file)) Error::Report('Render file not found', $file);
		$this->_renderExec($file);
	}
	
	private function _renderExec($file)
	{
		foreach($this->vars as $name=>$value)
			$$name = $value;
		require($file);
	}
}