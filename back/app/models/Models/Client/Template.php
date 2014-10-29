<?php
namespace Models\Client;

class Template extends \Eloquent
{
	protected $hidden = ['created_at', 'updated_at'];

	public static function boot()
    {
        parent::boot();
		
		\Models\Client\Template::created(function($template)
		{
			mkdir($template->storage());
		});
	}
	
	public function storage()
	{
		return storage_path() . '/templates/' . $this->id . '/';
	}
}