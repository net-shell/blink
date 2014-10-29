AdminPanelCtrl.prototype = 
{
	classes:
	{
		active:		"active",
		disabled:	"disabled",
		loading:	"ui loading"
	},

	messages:
	{
		saveOk: 	"Saved successfully",
		updateOk: 	"Updated successfully"
	},

	selectors:
	{
		actions:
		{
			all:		".navigation .actions.group .item",
			save:		".navigation .actions.group .item.save",
			update:		".navigation .actions.group .item.update"

		},
		editor:		"#editors .editor",
		iframe:		"#preview iframe",
		loader:		"#loader",
		modal:
		{
			dimmer:		"#dimmer",
			editor:		"#modal .editor",
			component:	"#modal .editor .component",
			container:	"#modal .container",
			self: 		"#modal",
			title:		"#modal .title"
		},
		preview:	"#preview"
	}
};

var ctrl = new AdminPanelCtrl("<?php echo $ClientAjaxUrl; ?>", "<?php echo $ClientBase; ?>");