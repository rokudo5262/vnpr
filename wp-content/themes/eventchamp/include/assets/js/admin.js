jQuery(document).ready(function($) {
	'use strict';



	// === Taxonomy Search for Metaboxes ==================================== //

	function gt_metabox_taxonomy_search() {

		$('.type-taxonomy-checkbox .format-setting-inner p:first-child').before('<input class="ot-taxonomy-search widefat option-tree-ui-upload-input " type="text" />'+'<span class="ot-taxonomy-search-clear-button"><a onclick="return false;" class="ot-taxonomy-search-clear option-tree-ui-button button button-primary light"><div class="dashicons dashicons-trash"></div></a></span>');
		
		$('.type-taxonomy-checkbox .format-setting-inner .ot-taxonomy-search').keyup(function(){
			var valThis = $(this).val().toLowerCase();
			$('.type-taxonomy-checkbox .format-setting-inner input[type=checkbox]').each(function(){
				var text = $("label[for='"+$(this).attr('id')+"']").text().toLowerCase();
				(text.indexOf(valThis) == 0) ? $(this).parent().show() : $(this).parent().hide();
			});
		});

		$(".type-taxonomy-checkbox .format-setting-inner .ot-taxonomy-search-clear").click(function(){
			$(".type-taxonomy-checkbox .format-setting-inner .ot-taxonomy-search").val("");
			$('.type-taxonomy-checkbox .format-setting-inner input[type=checkbox]').each(function(){
				$(this).parent().show();
			});
		});

	}
	gt_metabox_taxonomy_search();



	// === Post Type Search for Metaboxes ==================================== //

	function gt_metabox_post_type_search() {

		$('.type-custom-post-type-checkbox .format-setting-inner p:first-child').before('<input class="ot-custom-post-type-search widefat option-tree-ui-upload-input " type="text" />'+'<span class="ot-custom-post-type-search-clear-button"><a onclick="return false;" class="ot-custom-post-type-search-clear option-tree-ui-button button button-primary light"><div class="dashicons dashicons-trash"></div></a></span>');

		$('.type-custom-post-type-checkbox .format-setting-inner .ot-custom-post-type-search').keyup(function(){
			var valThis = $(this).val().toLowerCase();
			$('.type-custom-post-type-checkbox .format-setting-inner input[type=checkbox]').each(function(){
				var text = $("label[for='"+$(this).attr('id')+"']").text().toLowerCase();
				(text.indexOf(valThis) == 0) ? $(this).parent().show() : $(this).parent().hide();
			});
		});

		$(".type-custom-post-type-checkbox .format-setting-inner .ot-custom-post-type-search-clear").click(function(){
			$(".type-custom-post-type-checkbox .format-setting-inner .ot-custom-post-type-search").val("");
			$('.type-custom-post-type-checkbox .format-setting-inner input[type=checkbox]').each(function(){
				$(this).parent().show();
			});
		});

	}
	gt_metabox_post_type_search();



	// === Post Type Search for Metaboxes ==================================== //

	function gt_ot_editor_support() {

		if (window.wp.editor) {

			tinymce.init({
				selector: '.type-list-item textarea:not(".no-editor")',
				menubar: false,
				branding: false,
				min_height: 200,
				plugins: "textcolor link media",
				toolbar: "styleselect | bold | italic | underline | strikethrough | forecolor | alignleft | aligncenter | alignright | alignjustify | alignnone | link | unlink",
			});

			$(".option-tree-list-item-add").click(function(){
				setTimeout(function () {

					tinymce.init({
						selector: '.type-list-item textarea:not(".no-editor")',
						menubar: false,
						branding: false,
						min_height: 200,
						plugins: "textcolor link media",
						toolbar: "styleselect | bold | italic | underline | strikethrough | forecolor | alignleft | aligncenter | alignright | alignjustify | alignnone | link | unlink",
					});

				}, 1000);
			});

		}

	}
	gt_ot_editor_support();



});