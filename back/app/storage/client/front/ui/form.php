<form id="conf" class="hide">
	<?php foreach($cfg->Settings->Template as $gk=>$grp) foreach($grp as $sk=>$sng): ?>
	<input type="hidden" name="<?php echo $gk .'/'. $sk; ?>" value="<?php echo @($sng->v); ?>" />
	<?php endforeach; ?>
</form>