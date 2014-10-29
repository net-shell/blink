<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTables extends Migration
{

	public function up()
	{
		Schema::create('targets', function($table)
		{
			$table->increments('id');
			$table->string('name', 80);
			$table->string('slug', 2);
		});
	}

	public function down()
	{
		Schema::drop('targets');
	}

}
