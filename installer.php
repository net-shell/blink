<?php
$Settings = (object)array(
	'InstallDir'	=> 'ngin',
	'Source'		=> 'http://localhost:81/' . 'api/installer'
);

// Please do not edit the code below unless the force (of knowledge) is with you
ob_start();
$Timer = microtime(true);
$ScriptName = basename(__FILE__);
$URL = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$URL = str_replace($ScriptName, '', $URL);
$URL.= $Settings->InstallDir;

$Settings->InstallDir = __DIR__ . '/' . $Settings->InstallDir;

function Fail($Message)
{
	// todo: Gather environment info and report remotely
	// $Message .= ($Success ? 'The issue has been reported. Please contact support for <Install Issue #>' : 'We failed to report this issue.');
	die('<h1>Error '. $Message .'</h1>');
}

function AssurePath($Path, $IsFile = false)
{
	$Path = str_replace("\\", '/', $Path);
	
	if($IsFile)
		$Path = substr($Path, 0, strrpos($Path, '/'));
		
	if(file_exists($Path))
		return true;
	
	mkdir($Path, 0755, true) or Fail('creating the install directory');
}

if(file_exists($Settings->InstallDir))
{
	foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($Settings->InstallDir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $Path)
		$Path->isDir() ? rmdir($Path->getPathname()) : unlink($Path->getPathname());
	rmdir($Settings->InstallDir);
}

$Data = file_get_contents($Settings->Source);
$Data = json_decode($Data);
var_dump($Data);
(bool)$Data or Fail('fetching the source');

AssurePath($Settings->InstallDir);

foreach((array)$Data->Files as $File => $Contents)
{
	$Path = $Settings->InstallDir . $File;
	AssurePath($Path, true);
	$Contents = base64_decode($Contents);
	file_put_contents($Path, $Contents) or Fail('writing to file');
}

$Timer = microtime(true) - $Timer;
$Timer = round($Timer * pow(10, 3));

$DebugString = ob_get_clean();

$DebugString = preg_replace('/(\[.*\])/i', '<b>${1}</b>', $DebugString);
$DebugString = preg_replace('/(\".*\")/i', '<i>${1}</i>', $DebugString);

?><!doctype html>
<html>
	<head>
		<title>Installation Successfull</title>
		<!-- <meta http-equiv="refresh" content="3; url=<?php echo $URL; ?>"> -->
		<style type="text/css">
			body { text-align: center; color: #bbb; background: #000; }
			body { font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif; }
			h1 { margin: 4em 0 2em 0; color: #cf0; }
			h1, h2, small b { font-weight: 300; }
			a, a:visited { color: #09f; }
			a:hover { color: #fff; }
			small { display: block; color: #111; margin-top: 5em; padding-top: 1em; border-top: 1px solid #000; font-size: 1.5em; transition:.3s; }
			small:hover { color: #fff; box-sizing: border-box; border-color: orange; background: #111; }
			small:hover > pre > b { color: orange; }
			small:hover > pre > i { color: #999; }
			pre { text-align: left; margin: 0 10%; overflow-x: hidden; }
			.click { display: inline-block; padding: .4em 1.6em; background-color: #000; transition: .3s; }
			.click:hover { background-color: #09f; text-decoration: none; }
		</style>
	</head>
	<body>
		<h1>Installation Successfull</h1>
		<h2>
			<div>What's next?</div>
			<a class="click" href="<?php echo $URL; ?>">Visit the management page.</a>
		</h2>
		<small>
			<div>Debug Info</div>
			<div>
				Process took
				<b><?php echo $Timer; ?></b>ms
				and ended at
				<b><?php echo date('H</b>\h <b>i</b>\' <b>s</b>"'); ?></b>
			</div>
			<pre><?php echo $DebugString; ?></pre>
			</small>
	</body>
</html>