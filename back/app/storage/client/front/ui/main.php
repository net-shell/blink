<?php
	function Insert($sections, $isDirList = false)
	{
		if($isDirList) sort($sections);
		foreach($sections as $section)
		{
			include($section . ($isDirList ? '' : '.php'));
		}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>tMpl8 Ngin</title>
	<link rel="stylesheet" href="<?php echo $AssetsUrl; ?>semantic/css/semantic.min.css" />
	<link rel="stylesheet" href="<?php echo $AssetsUrl; ?>colorpicker/css/colorpicker.css" />
	<link rel="stylesheet" href="<?php echo $AssetsUrl; ?>jquery/scrollbar.css" />
	<script type="text/javascript" src="<?php echo $AssetsUrl; ?>jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $AssetsUrl; ?>colorpicker/js/colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo $AssetsUrl; ?>semantic/js/semantic.min.js"></script>
	<script type="text/javascript" src="<?php echo $AssetsUrl; ?>jquery/scrollbar.js"></script>
	<style><?php
		$css = Template::ListDir(__DIR__ . '/css/', '.css');
		sort($css);
		foreach ($css as $file) include($file);
	?></style>
	<script>(function($){<?php
		$js = Template::ListDir(__DIR__ . '/js/', '.js');
		sort($js);
		foreach ($js as $file)
		{
			include($file);
			echo "\n";
		}
	?>})(jQuery);
	</script>
</head>
<body>
	<?php if(@is_object($cfg->Settings->Template)): ?>
	<div id="wrap">
		<div class="page">
			<?php foreach(array('navigation', 'sidebar', 'content') as $file) include("$file.php"); ?>
		</div>
		<div class="hide">
			<?php foreach(array('editors', 'form') as $file) include("$file.php"); ?>
		</div>
	</div>
	<?php endif; ?>
</body>
</html>