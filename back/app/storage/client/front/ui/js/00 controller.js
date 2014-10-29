function AdminPanelCtrl(ajaxUrl, siteUrl)
{
	// Constructor

	this.ajaxUrl = ajaxUrl;
	this.siteUrl = siteUrl;
	this.saveXhr = null;

	// Methods

	this.GetConfigInput = function(name)
	{
		return $("form#conf input[name='" + name + "']");
	}

	this.MenuToggleClicked = function()
	{
		$(this).parent().children().removeClass(ctrl.classes.active);
		$(this).addClass(ctrl.classes.active);
	}

	this.PreviewLoaded = function()
	{
		this.style.height = this.contentWindow.document.body.scrollHeight + 'px';
		var frame = $(ctrl.selectors.iframe).contents();
		//frame.find("#wpadminbar").remove();		
		$(ctrl.selectors.loader).removeClass(ctrl.classes.active);
	};

	this.InitIFrame = function()
	{
		return $(ctrl.selectors.iframe).attr("src", ctrl.siteUrl);
	}

	this.ReloadIFrame = function()
	{
		ctrl.iframe = false;
		$(ctrl.selectors.actions.all).attr("disabled", true);
		ctrl.InitIFrame().one("load", function(){
			ctrl.iframe = $(this);
			$(ctrl.selectors.actions.all).attr("disabled", false);
		});
	}

	this.UpdateScroll = function()
	{
		$(ctrl.selectors.preview).perfectScrollbar("update");
	}

	this.ModeChanged = function()
	{
		// is preview mode:
		// $(".navigation .preview.item").is(".active");
	};

	this.SettingsOkClick = function()
	{
		var c = $(ctrl.selectors.modal.component);
		var n = $(ctrl.selectors.modal.editor).data("name");
		var t = $(ctrl.selectors.modal.editor).data("type");
		var v = c.val();
		switch(t)
		{
			case "color":
				v = c.data("value");
				break;
		}
		if(typeof v != "undefined")
		{
			ctrl.SetSavedState(ctrl.GetConfigInput(n).val() == v);
			ctrl.GetConfigInput(n).val(v);
		}
		ctrl.CloseModal();
	};

	this.ShowDimmer = function(msg)
	{
		$(ctrl.selectors.modal.dimmer).dimmer("show").find(".message").text(msg).fadeIn(100);
		window.setTimeout("jQuery(\""+ ctrl.selectors.modal.dimmer +"\").dimmer(\"hide\");", 1500);
	};

	this.OpenModal = function(name)
	{
		ctrl.CloseModal();
		$(ctrl.selectors.modal.container).children("div[name='"+ name +"']").show();
		$(ctrl.selectors.modal.self).addClass(ctrl.classes.active);
	};

	this.CloseModal = function()
	{
		$(ctrl.selectors.modal.self).removeClass(ctrl.classes.active);
		$(ctrl.selectors.modal.container).children().hide();
	}

	this.ActionSave = function()
	{
		var element = $(ctrl.selectors.actions.save);
		if(element.is(".disabled")) return;
		var fdata = $("form#conf").serialize();
		if(ctrl.saveXhr) ctrl.saveXhr.abort();
		ctrl.saveXhr = $.post(ctrl.ajaxUrl, { action: "save", data: fdata }, ctrl.CallbackSave);
	};

	this.CallbackSave = function(data)
	{
		ctrl.ShowDimmer(ctrl.messages.saveOk);
		ctrl.SetSavedState(true);
		element.data("notify", "");
	};

	this.ActionUpdate = function()
	{
		ctrl.ActionSave();
		var element = $(ctrl.selectors.actions.update);
		$(ctrl.selectors.loader).addClass(ctrl.classes.active);
		$.post(ctrl.ajaxUrl, { action: "update" }, function(rdata) {
			$(ctrl.selectors.iframe).attr("src", function(i, val){ return val; }).one("load", ctrl.CallbackUpdate);
			element.removeClass(ctrl.classes.loading);
		});
		element.addClass(ctrl.classes.loading);
	};

	this.CallbackUpdate = function(data)
	{
		ctrl.ShowDimmer(ctrl.messages.updateOk);
	};

	this.SetSavedState = function(newState)
	{
		var element = $(ctrl.selectors.actions.save);
		if(newState) element.addClass(ctrl.classes.disabled);
		else element.removeClass(ctrl.classes.disabled);
	};

	this.SettingClicked = function()
	{
		var a = $(this);
		var i = a.data("info") || "Setting value:";
		var n = a.data("name");
		var t = a.data("type") || "default";
		var v = a.data("value");
		var v1 = ctrl.GetConfigInput(n).val();
		if(v1.length > 0) v = v1;
		
		ctrl.OpenModal("settings");

		var html = $(ctrl.selectors.editor +"."+ t).html();
		$(ctrl.selectors.modal.editor).html(html);
		
		var c = $(ctrl.selectors.modal.component);
		$(ctrl.selectors.modal.title).text(n.substring(1 + n.indexOf('/')));
		$(ctrl.selectors.modal.self + " .info").html(i);
		$(ctrl.selectors.editor)
		.data("type", t)
		.data("name", n);
		
		switch(a.data("type")) {
			case "color":
				c.ColorPicker({
					flat: true,
					color: v,
					onChange: function(hsb, hex, rgb) { $(c).data("value", "#"+ hex); }
				});
				break;
			default:
				c.val(v);
				break;
		}
		
		c.focus();
	};

	this.SettingsItemClicked = function()
	{
		collapseSettings();
		var me = $(this);
		me.addClass(ctrl.classes.active).next(".content").show(100);
	};
}