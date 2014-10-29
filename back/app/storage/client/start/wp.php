<?php

class WpStart
{
	public static function Init($app)
	{
		$app->vars['EnvRootPath']	= realpath(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('..' . DIRECTORY_SEPARATOR, 2));
		$app->vars['envTplPath'] = 'wp-content/themes/';
	}
}