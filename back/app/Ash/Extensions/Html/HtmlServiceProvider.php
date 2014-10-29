<?php

namespace Ash\Extensions\Html;

class HtmlServiceProvider extends \Illuminate\Html\HtmlServiceProvider
{
	protected function registerHtmlBuilder()
	{
		$this->app->bindShared('html', function($app)
		{
			return new HtmlBuilder($app['url']);
		});
	}
}