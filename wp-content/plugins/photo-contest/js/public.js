(function ( $ ) {
	"use strict";

  //Voting in the detail page
  $(function () {
		jQuery('div.photo_vote').one('click', function() {

			$("div.pc-show").fadeOut(0);
			$("div.pc-load").fadeIn(0);

			var photoId = jQuery(this).data('item');
			var nonceId = jQuery(this).data('nonce');
			var shareId = jQuery(this).data('share');
			var optionId = jQuery(this).data('option');
			var num = parseInt($.trim($('.pc-votes-count').html()));
			var data = {
					action: 'vote_for_photo',
					photo_id: photoId,
					nonce_id: nonceId,
					option_id: optionId,
				};
				$.post(ajaxurl, data, function(response) {
					    if (shareId == 1) {
						 history.pushState(null, "", location.href.split("#")[0]  + "&vote=ok");
                         location.reload();
                        }

        $("div.pc-load").fadeOut(0);
				$("div.pc-hide").fadeIn(2000);
				$(".pc-votes-count").html(++num)

			});
		});//one click function
	});//function

	//Rating
	$(function () {
		jQuery('.rate_vote').one('click', function() {
			$("div.pc-show").fadeOut(0);
			$("div.pc-load").fadeIn(0);

			var itemId = jQuery(this).data('item');
			var nonceId = jQuery(this).data('nonce');
			var shareId = jQuery(this).data('share');
			var optionId = jQuery(this).data('option');
			var valueId = jQuery(this).data('value');
			var num = parseInt($.trim($('.pc-votes-count').html()));
			var data = {
				action: 'rate_for_photo',
				item_id: itemId,
				nonce_id: nonceId,
				option_id: optionId,
				value_id: valueId,
			};

			$.post(ajaxurl, data, function(data) {
				if (shareId == 1) {
					history.pushState(null, "", location.href.split("#")[0]  + "&vote=ok");
					location.reload();
				}
				$("div.pc-load").fadeOut(0);
				$("div.pc-hide").fadeIn(1500);
				$("span.starsfield").fadeOut(0);
				$("span.starsfield").html(data).fadeIn(1500);
			}
			);
		});//one click function
	});//function

  $(function () { //Jury vote function

		jQuery('.jury_vote').one('click', function() {
		history.pushState(null, "", location.href.split("#")[0]  + "&jury=ok");
        var photoId = jQuery(this).data('item');
				var optionId = jQuery(this).data('option');
				var valueId = jQuery(this).data('value');
        var data = {
            action: 'vote_for_photo_jury',
            photo_id: photoId,
						option_id: optionId,
						value_id: valueId,
        };
        $.post(ajaxurl, data, function(response) {
                location.reload();
        });
    });

  });

	$(function () { //Jury remove the vote function

		jQuery('div.jury_vote_undo').one('click', function() {
		history.pushState(null, "", location.href.split("#")[0]  + "&jury=removed");
        var photoId = jQuery(this).data('item');
				var optionId = jQuery(this).data('option');
        var data = {
            action: 'vote_for_photo_jury_undo',
            photo_id: photoId,
						option_id: optionId,
        };
        $.post(ajaxurl, data, function(response) {
                location.reload();
        });
    });

  });


  //QrCode
  $(document).ready(function(){
		$(".pc-showqrcode").click(function(){
			$(".pc-hiddenqrcode").slideToggle(400);
		})
  });
  //URL Link
  $(document).ready(function(){
		$(".pc-showlink").click(function(){
			$(".pc-hiddenlink").slideToggle(400);
		})
  });
	//Vote button
  $(document).ready(function(){
		$(".pc-showbutton").click(function(){
			//$(".pc-hiddenbutton").slideToggle(400);
			$(".pc-showbutton").fadeOut(0);
			$(".pc-hiddenbutton").fadeIn(2000);
		})
  });

}(jQuery));

function selectText(id){
    var sel, range;
    var el = document.getElementById(id); //get element id
    if (window.getSelection && document.createRange) { //Browser compatibility
      sel = window.getSelection();
      if(sel.toString() == ''){ //no text selection
         window.setTimeout(function(){
            range = document.createRange(); //range object
            range.selectNodeContents(el); //sets Range
            sel.removeAllRanges(); //remove all ranges from selection
            sel.addRange(range);//add Range to a Selection.
        },1);
      }
    }else if (document.selection) { //older ie
        sel = document.selection.createRange();
        if(sel.text == ''){ //no text selection
            range = document.body.createTextRange();//Creates TextRange object
            range.moveToElementText(el);//sets Range
            range.select(); //make selection.
        }
    }
}

function pc_copylink() {
  /* Get the text field */
  var copyText = document.getElementById("linkurl");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("Copy");
}
