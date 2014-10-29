<?php
$config = [
	'APIKey' => '567minus9lives/you\'veArrived@panicStation',
	'Settings' => []
];

// Set theme settings defaults
$config['Settings']['Template']['Basic'] = [
	'Theme Color' =>
	[
		'i' => 'The accent color of the theme.',
		't' => 'color',
		'v' => '#79d41e'
	],
	'Copyright' => ['v' => 'Neshto']
];

function arrayToObject($array)
{
	foreach($array as $key=>$value)
		if(is_array($value))
			$array[$key] = arrayToObject($value);
	
	return (object)$array;
}

$config = arrayToObject($config);
echo json_encode($config);