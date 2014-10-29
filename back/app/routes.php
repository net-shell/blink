<?php

Route::group(['prefix' => '/api', 'namespace' => 'Client'], function()
{
	Route::controller('/template', 'TemplateCtrl');
	Route::controller('/installer', 'InstallerCtrl');
});

Route::get('/', function()
{
	return View::make('hello');
});