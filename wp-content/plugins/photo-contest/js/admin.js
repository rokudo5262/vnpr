(function ( $ ) {
	"use strict";

	$(function () {

		//Add datepicker for contest start
    $('.contest-start').datepicker({ dateFormat: "mm/dd/yy" });
    //Add datepicker for contest end
    $('.contest-end').datepicker({ dateFormat: "mm/dd/yy" });
	//Add datepicker for contest start vote
    $('.contest-start-vote').datepicker({ dateFormat: "mm/dd/yy" });

	$( "#datepicker" ).datepicker({ dateFormat: "mm/dd/yy" });
	$( "#datepicker2" ).datepicker({ dateFormat: "mm/dd/yy" });
	$( "#datepicker3" ).datepicker({ dateFormat: "mm/dd/yy" });
	$( "#datepicker4" ).datepicker({ dateFormat: "mm/dd/yy" });

	});

	//Open Create contest
	$(function () {
		jQuery(".form-show").on("click", function(){
			$(".form-hide").show(1000);
		})
	});//function

	//Open bulk upload
	$(function () {
		jQuery(".bulk-show").on("change", function(){
			$(".bulk-hide").show(500);
		})
	});//function

}(jQuery));

jQuery(function($) { // DOM is now ready and jQuery's $ alias sandboxed
    $(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
     });
   });
});

jQuery(function($) { // DOM is now ready and jQuery's $ alias sandboxed
    $(document).ready(function () {
    $("#ckbCheckAll2").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
     });
   });
});

jQuery(function($) {
	if ($('.modern_check').prop('checked')) {
	    $(".mcolors").show(1000);
	}
});

function submitcontest() {
    document.getElementById("contest-form").submit();
}
