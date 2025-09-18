/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 // Make jQuery global first
 import $ from 'jquery';
 window.$ = window.jQuery = $;

import './bootstrap';
import 'jquery-ui-dist/jquery-ui.min.js';
 
 // Legacy jQuery plugins
 import './jquery.autocomplete.min.js';
 import './jquery.form.min.js';
 import './jquery.maskedinput.min.js';

(function($) {
	window.AjaxConfirmDialog = function(msg, title, url, redirect, record, reload=true, el=null, showstatus=false, statusel=null) {
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

	    $("#dialog-confirm").html(msg);
	
	    // Define the Dialog and its properties.
	    $("#dialog-confirm").dialog({
	        resizable: false,
	        show: {
		        effect: "fade",
		        duration: 300
	        },
	        hide: {
		        effect: "fade",
		        duration: 300
	        },
	        open: function(event,ui) {
		        $(".ui-widget-overlay").addClass('custom-overlay');
		        $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
	        },
	        close: function(event,ui) {
		        $(".ui-widget-overlay").removeClass('custom-overlay');
	        },
	        modal: true,
	        title: title,
	        height: 250,
	        width: 400,
	        buttons: {
	            "Yes": function () {
	                $(this).dialog('close');
	                if(record!='') {
		                $.ajax({
			                url: url,
			                data: {record : record},
			                type: 'POST',
			                dataType: 'html',
			                success: function(data) {
				                if($redirect!='')
					                window.location = redirect;
			                }
		                });
	                } else {
		                $.ajax({
			                url: url,
			                type: 'POST',
			                dataType: 'html',
			                success: function(data) {
				                if(reload) {
					                window.location = redirect;
					            } else {
						            if(el!==null) {
							            el.fadeOut(300,function() { el.remove(); });
							        } else if(showstatus) {
								        statusel.removeClass('hide').text(data).slideDown(300,function() {
									        statusel.fadeTo(2000, 500).slideUp(500, function(){
											    statusel.slideUp(500);
											});
								        });
							        }
					            }
			                }
		                });
	                }
	            },
	            "No": function () {
	                $(this).dialog('close');
	            }
	        }
	    });
	}
	window.SubmitConfirmDialog = function(msg, title, formEl) {
	    $("#dialog-confirm").html(msg);
	
	    // Define the Dialog and its properties.
	    $("#dialog-confirm").dialog({
	        resizable: false,
	        show: {
		        effect: "fade",
		        duration: 300
	        },
	        hide: {
		        effect: "fade",
		        duration: 300
	        },
	        open: function(event,ui) {
		        $(".ui-widget-overlay").addClass('custom-overlay');
		        $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
	        },
	        close: function(event,ui) {
		        $(".ui-widget-overlay").removeClass('custom-overlay');
	        },
	        modal: true,
	        title: title,
	        height: 250,
	        width: 400,
	        buttons: {
	            "Yes": function () {
	                $(this).dialog('close');
	            },
	            "No": function () {
	                $(this).dialog('close');
	                formEl.submit();
	            }
	        }
	    });
	}
	$(document).ready(function() {
		$('div.hover').mouseenter(function() {
			if(!$(this).hasClass('selected')) {
				var src = $(this).find('img').attr('src');
				$(this).addClass('active').find('img').attr('src',src.replace('.png','-hover.png'));
			}
		}).mouseleave(function() {
			if(!$(this).hasClass('selected')) {
				var src = $(this).find('img').attr('src');
				$(this).removeClass('active').find('img').attr('src',src.replace('-hover',''));
			}
		}).click(function() {
			var el = $(this);
			var src = $(this).find('img').attr('src');
			$(this).addClass('selected').find('img').attr('src',src.replace('-hover.png','.png').replace('.png','-hover.png'));
			if($(this).data('option')=='4') {
				$('.dates').slideDown(200);
			}
			$("div.hover").not(this).removeClass("selected");
			$.each($("div.hover:not(.selected)"),function() {
				src = $(this).find('img').attr('src');
				$(this).removeClass('active').removeClass("selected").find('img').attr('src',src.replace('-hover',''));
				if($(this).data('option')=='4') {
					$('.dates').slideUp(200);
				}
			});
		});
/*
	    if($('input[name=phone], input[name=cell], input[name=work]').length) {
			$("input[name=phone], input[name=cell], input[name=work]").mask("999-999-9999");
	    }
*/
	    $( "input.datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate:'-90y',
			yearRange:"1930:2025",
			altFormat:"mm-dd-YYYY"
	    });
	    if($('input.datepicker').length) {
			$("input.datepicker").mask("99/99/9999");
	    }
		
	});
	$(window).on('load',function() {
		$( "input.radios" ).checkboxradio({
	      icon: false
	    });
	});
    if($(".alert").length) {
		$(".alert").not(".nohide").fadeTo(2000, 500).slideUp(500, function(){
		    $(".alert").slideUp(500);
		});
    }
})(window.jQuery);