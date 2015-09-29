//TinyMCE
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "safari,spellchecker,pagebreak,advhr,emotions,inlinepopups,insertdatetime,preview,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	// Theme options
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink",
	theme_advanced_buttons2 : "image,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,sub,sup,|,charmap,emotions,advhr,|,cite,abbr,acronym,del,ins,|,pagebreak,spellchecker,code",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resize_horizontal : false,
	theme_advanced_resizing : true,

	language : 'es',
	spellchecker_languages : "+Español=es,Ingles=en",
	relative_urls : false,
	convert_urls : false,

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js",
	
	//extended_valid_elements : "iframe[src|width|height|name|align|frameborder|allowfullscreen],blockquote,  blockquote[data-instgrm-captioned|data-instgrm-version],script[async|src|charset], time, time[datetime]",
	extended_valid_elements : "*[*]",

	editor_deselector: "tinyNoEditor",
	
	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}



	
});

function toggleEditor(id) {
	if (!tinyMCE.get(id))
		tinyMCE.execCommand('mceAddControl', false, id);
	else
		tinyMCE.execCommand('mceRemoveControl', false, id);
}

