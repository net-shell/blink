<div class="ui dimmer" id="modal">
	<div class="content">
		<div class="center">
			<h2 class="ui header">
				<span class="title"></span>
			</h2>
			<div class="container">
				<?php
					$dir = __DIR__ . DIRECTORY_SEPARATOR . 'modals' . DIRECTORY_SEPARATOR;
					foreach(scandir($dir) as $file)
					{
						if(substr($file, -4) == '.php')
						{
							echo '<div name="', substr($file, 0, -4), '">';
							include($dir . $file);
							echo '</div>';
						}
					}
				?>
			</div>
		</div>
	</div>
</div>

<div id="dims">
	<div class="ui page dimmer" id="dimmer">
		<div class="content">
			<div class="center">
				<h2 class="ui inverted icon header">
					<i class="icon circular inverted emphasized info"></i>
					<div class="message"></div>
				</h2>
			</div>
		</div>
	</div>
</div>