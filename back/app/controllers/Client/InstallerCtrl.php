<?php

namespace Client;

class InstallerCtrl extends \BaseController
{
	// Returns client files as JSON dump
	public function getIndex()
	{
		$storage = realpath(storage_path() . '/client');
		$files = \File::allFiles($storage);
		$result = array();
		$runExt = '.run.php';
		$skip = ['.db'];
		
		foreach($files as $file)
		{
			$path = $file->getRealPath();
			$name = str_replace($storage, '', $path);
			$name = str_replace("\\", '/', $name);
			$runExtOffset = -1 * strlen($runExt);
			
			if(in_array(substr($name, strrpos('.', $name)), $skip))
				continue;
			elseif(substr($name, $runExtOffset) == $runExt)
			{
				$name = substr($name, 0, $runExtOffset);

				ob_start();
				include($path);
				$buffer = ob_get_clean();

				$result[$name] = $buffer;
			}
			else
				$result[$name] = file_get_contents($path);

			$result[$name] = base64_encode($result[$name]);
		}
		
		$result = [
			'Version' => $this->getVersion(),
			'Files' => $result
		];

		return \Response::JSON($result);
	}

	function getVersion()
	{
		return filemtime(storage_path() . '/client');
	}
}