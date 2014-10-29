<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email',			120);
			$table->string('name',			80);
			$table->string('password',		120);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}
