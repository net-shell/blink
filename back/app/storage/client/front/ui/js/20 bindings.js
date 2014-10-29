$(function()
{	
	$("iframe")
	.bind("load", ctrl.PreviewLoaded);
		
	// Settings editor	
	$("#settingsEditor .content > a.item")
	.bind("click", ctrl.SettingClicked);
	
	$("#settingsEditor > .item")
	.bind("click", ctrl.SettingsItemClicked);

	// Navigation
	$(".navigation .toggle.group .item")
	.bind("click", ctrl.MenuToggleClicked);

	$(".navigation .preview.group .item")
	.bind("click", ctrl.ModeChanged);

	// Actions
	$(".navigation .save.button")
	.bind("click", ctrl.ActionSave);
	
	$(".navigation .update.button")
	.bind("click", ctrl.ActionUpdate);
});