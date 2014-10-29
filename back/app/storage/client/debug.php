<?php

class Error
{
	public static function Report($error, $dump = array())
	{
		echo '<pre>';
		if(count($dump))
			var_dump($dump);
		echo '</pre>';
		
		echo '<h1>Error: ', $error, '</h1>', '<h2>Backtrace:</h2>';
		debug_print_backtrace();
		
		exit;
	}
}