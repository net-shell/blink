<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{

	public function up()
	{
		Schema::create('templates', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name', 80);
			$table->text('details')->nullable();
			$table->float('price')->nullable();

			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	public function down()
	{
		Schema::drop('templates');
	}

}
