/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

(function ($) {
    "use strict";

    $.fn.zufusiontable = function (options) {
        var settings = $.extend({
            breakpoint: {
                xs: 480,
                sm: 576,
                md: 992,
                lg: 1200,
                xlg: 1400,
            },
            iconPlus: '<i class="fa fa-plus text-info"></i>',
            iconMinus: '<i class="fa fa-minus text-danger"></i>',
            allExpended: false
        }, options);

        var tableSelector = this;
        $(window).resize(function () {
            responsive_table();
        });

        responsive_table();

        function responsive_table() {
            var screen_size = $(window).width();

            tableSelector.each(function () {
                var table = $(this);

                //all expanded
                var all_expanded = table.data('all-expanded');

                //If not defined in data we get settings from options
                if ((typeof all_expanded == "undefined")) {
                    all_expanded = settings.allExpended;
                }

                //Count nb cols has defined with data-breakpoint
                var th = table.find("thead tr:first th[data-breakpoint]");
                var totalColumns = th.length;

                //Return false if no column found
                if (totalColumns <= 0)
                    return false

                //Get all rows contain in tbody
                var rows = table.find("> tbody > tr").not(".zufusiontable-row");

                //loop all row to add a row responsive
                rows.each(function (index) {
                    var row = $(this);
                    var td = row.find("td");

                    var formated = row.data('formated');

                    //allow to expend automatically a row
                    var expanded = row.data('expanded');

                    var html = '<table class="zufusiontable-subtable table table-bordered"><tbody>';

                    var totalElement = 0;
                    for (var i = 0; i < th.length; i++) {
                        //get current th information
                        var current_th = th.eq(i);
                        var columnPosition = current_th.prop("cellIndex") + 1;
                        var breakpoint = current_th.data('breakpoint');

                        //get current td information
                        var current_td = row.find("td:nth-child(" + (columnPosition) + ")");

                        //Allow to use a custom title instead of th
                        var title = current_td.data('title');
                        if (typeof title == "undefined" || title == "") {
                            title = current_th.html();
                        }

                        //Check if tf column exist at specified position
                        if (current_td <= 0) {
                            console.log('TD Column ' + columnPosition + ' not found');
                            return false;
                        }

                        if (settings.breakpoint[breakpoint] !== "undefined" && settings.breakpoint[breakpoint] >= screen_size) {

                            html += '<tr class="zufusiontable-subrow"> ' +
                                '<td class="zufusiontable-subcol" style="width:30%; background:#eee;">' + title + '</td> ' +
                                '<td class="zufusiontable-subcol">' + current_td.html() + '</td> ' +
                                '</tr>';

                            //Hide column selected
                            current_th.hide();
                            current_td.hide();
                            totalElement++;
                        } else {
                            //show column selected
                            current_th.show();
                            current_td.show();
                        }
                    }

                    html += '</tbody></table>';

                    if (typeof formated == "undefined" && totalElement > 0) { //Create zufusiontable
                        row.data('formated', true);
                        row.after('<tr id="zufusiontable-row-' + index + '" class="zufusiontable-row"> <td colspan="100%" class="zufusiontable-col"> ' + html + ' </td> </tr>');
                        var buttonIcon = settings.iconMinus;
                        if ((typeof expanded == "undefined" || expanded == false) && (typeof all_expanded == "undefined" || all_expanded == false)) {
                            $("#zufusiontable-row-" + index, table).hide();
                            buttonIcon = settings.iconPlus;
                        }
                        //Add button collapse
                        $("#zufusiontable-row-" + index, table).prev().find('td:visible').first().prepend('<a href="javascript:void(0);" class="zufusiontable-collapse" data-opened="true">' + buttonIcon + '</a>');
                    } else if (formated && totalElement > 0) { //update zufusiontable
                        $('#zufusiontable-row-' + index + ' > td', table).html(html);
                    } else if (totalElement <= 0) { //Remove zufusiontable
                        row.removeData('formated');
                        $("#zufusiontable-row-" + index, table).remove();
                        //remove button collapse
                        $(".zufusiontable-collapse", table).remove();
                    }
                });
            });
        }

        //Event collapse on click to open or close zufusiontable
        $('body').unbind().on('click', '.zufusiontable-collapse', function (e) {
            e.preventDefault();
            var $this = $(this);
            var zufusiontable_row = $this.closest("td").closest("tr").next();
            //if Row is visible
            if (zufusiontable_row.is(':visible')) {
                //hide row
                zufusiontable_row.fadeOut("fast");
                //change the icon to plus
                $this.html(settings.iconPlus);
            } else {
                //show row
                zufusiontable_row.fadeIn();

                //change the icon to minus
                $this.html(settings.iconMinus);
            }
        });
    };


})(jQuery);