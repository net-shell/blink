<div class="sidebar">
	<div class="ui large vertical inverted labeled icon menu active" id="menu">
		<h2 class="item header">
			Theme Settings
		</h2>
		<?php if(!@is_object($cfg->Settings->Template)): ?>
		<div class="item">
			<i>Error loading configuration file.</i>
		</div>
		<?php else: ?>
		<div id="settingsEditor">
			<?php foreach($cfg->Settings->Template as $groupKey=>$group): ?>
			<a class="icon item" href="javascript:void(0)">
				<i class="open folder icon"></i>
				<?php echo $groupKey; ?>
			</a>
			<div class="content">
				<?php foreach($group as $key=>$data): ?>
				<a class="item"
					data-info="<?php echo @($data->i); ?>"
					data-name="<?php echo $groupKey . '/' . $key; ?>"
					data-type="<?php echo @($data->t); ?>"
					data-value="<?php echo @($data->v); ?>"
					href="javascript:void(0);"><?php echo $key; ?></a>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</div>