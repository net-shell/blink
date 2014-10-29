<?php
namespace Ash\Engine;

class SiteServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        $this->app->bind('site', function()
        {
            return new Site;
        });
    }

}