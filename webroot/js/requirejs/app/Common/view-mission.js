require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'slickcarousel', 'stickykit', 'sidr', 'jqueryui'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			$('#missions-body').css("margin-top",$('#missions-menu').height());
			$('.close-sidebar-button').css("top",$('#missions-menu').height()+40);

			//--------------------------------------------//
			//Creates carousel
			//--------------------------------------------//
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  adaptiveHeight: false,
			  responsive: true,
			  slidesToShow: 1,
			  lazyLoad: 'progressive',
			  arrows: true,
			  onInit: function(slider) {
			  },
			  onBeforeChange: function(slider, currentIndex, targetIndex){
			  	//Page number
			  	$('#page-number').html(targetIndex+1);
			  },
			  onAfterChange: function(slider,index){
				//Coordinate heights of carousel wrap and content overlay
				var img = jQuery(slider.$slides[index]).children('img');
			  	var sliderHeight = $(img).height();
			  	jQuery(slider.$slider).height(sliderHeight);

			  	//Go to the top of the page
				$("html, body").animate({
					scrollTop: 0
				}, 300);
			  }
			});

			$('.missions-carousel').slickGoTo(0);

			//Changes the position of the arrows
			$('#slickPrevArrow').append($('.slick-prev'));
			$('#slickNextArrow').append($('.slick-next'));

			//Hide sidebar content
			$('#missionSidebar').hide().removeClass("hidden");
			$('.tabContent').hide().removeClass("hidden");
			$('#missions-content-overlay').hide().removeClass("hidden");

			//--------------------------------------------//
			//Off canvas
			//--------------------------------------------//
			function open_sidr(sidr_button,sidr_source) {
				$(sidr_source).addClass("sidr-open");

				//Opacity behind
				$(sidr_button+" span").addClass("text-color-highlight").removeClass("text-color-gray"); //Icon highlight
				$('.main-section .missions-content').addClass('blur-strong opacity-04'); //Blur everything else
				$('.right-small-content').addClass('opacity-08').removeClass('opacity-07'); //Increase opacity in the buttons
				
				//Show content in front
				$('.mission-sidebar').css("height",""); //restart data-equalizer of the sidebar columns
				$('#missionSidebar').show("slide", { direction: "left" }, 500, function(){
					$(sidr_source).fadeIn('fast');
					$(document).foundation('equalizer', 'reflow'); //data-equalizer for sidebar columns
				});

				//Possible to close sidr
				$('.close-sidebar-button').removeClass("hidden");
			}

			function close_sidr(sidr_button,sidr_source) {
				$(sidr_source).removeClass("sidr-open");

				//Opacity behind
				$(sidr_button+" span").removeClass("text-color-highlight").addClass("text-color-gray"); //Icon grey
				$('.main-section .missions-content').removeClass('blur-strong').removeClass('opacity-04'); //Blur everything else
				$('.right-small-content').addClass('opacity-07').removeClass('opacity-08'); //Decrease opacity in the buttons

				//Show content in front
				$('#missionSidebar').hide("slide", { direction: "left" }, 500, function(){
					$(sidr_source).fadeOut('fast');
				});

				//Not possible to close sidr
				$('.close-sidebar-button').addClass("hidden");
			}

			function close_current_tab() {
				//Close currently open tab
				var open_tab = $('.sidr-open');
				if ($(open_tab).length) {
					var open_tab_id = $(open_tab).attr('id');
					close_sidr('#menu-icon-'+open_tab_id,'#'+open_tab_id);
				}
			}

			$('.menu-icon').click(function(){
				var idTabContent = $(this).data('tab-content');
				var idMenuIcon = $(this).attr("id");

				//Close tab
				if ($('#'+idTabContent).hasClass("sidr-open")) {
					close_sidr('#'+idMenuIcon,'#'+idTabContent);
				}
				//Open tab
				else {
					close_current_tab();

					//Open desired
					open_sidr('#'+idMenuIcon,'#'+idTabContent);
				}
			});

			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			var left_small_margin_top = - $('.left-small').height() / 2;
			$('.left-small').css("margin-top",left_small_margin_top); //NECESSARY IF BODY HAS OVERFLOW:AUTO

			//--------------------------------------------//
			//Close overlay button
			//--------------------------------------------//
			$(".close-missions-content-overlay").click(function(){
				//Hide content overlay and show tab-bar and main section
				$('.main-section').removeClass("hidden");
				$('.tab-bar').removeClass("hidden");
				$('#missions-content-overlay').fadeOut('fast');

				//Clear content-body and its events
				$('#missions-content-overlay-body').off(); //clear events in previous elements
				$('#missions-content-overlay-body *').off(); 
				$('#missions-content-overlay-body').html('');
			});

			//--------------------------------------------//
			//Close sidebar (mission content)
			//--------------------------------------------//
			$(".close-sidebar-button").click(function(){
				//Show content in front
				close_current_tab();

				//Not possible to close sidr
				$(this).addClass("hidden");
			});
			

			//--------------------------------------------//
			//EVIDENCE: ADD EVIDENCE FORM OPENS ON THE MISSION-OVERLAY ON THE LEFT
			//--------------------------------------------//
			$(".submit-evidence.button").click(function(event){
				$.ajax({
					url: $(this).attr("href")+"/true",
					type:"POST",
					beforeSend: function() {
						$('#missions-content-overlay .content-body').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
						$('#missions-content-overlay').fadeIn('slow');
						$('.main-section').addClass("hidden");
						$('.tab-bar').addClass("hidden");
					},
					success: function(data) {
						//Go to the top of the page
						$("html, body").animate({
							scrollTop: 0
						}, 300);

						//Display content
						$('#missions-content-overlay-body').off(); //clear events in previous elements
						$('#missions-content-overlay-body *').off(); //clear events in previous elements
						$("#missions-content-overlay-body").html(data);

						//Reflow
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
				event.preventDefault();
			});
		    
			//--------------------------------------------//
		    //REFLOW FOUNDATION - After setting up slick (or generating any other elements), foundation needs to be updated
		    //--------------------------------------------//
			$(document).foundation('reflow');

			
			/*
			//http://blog.jonathanargentiero.com/?p=335
			//Using lazy load with foundation interchange
			function lazyInterchange(selector){
			       if($(selector).attr('data-lazy')){
			                $(selector).attr('data-interchange',$(selector).attr('data-lazy'));
			                $(document).foundation('reflow');
			                $(selector).removeAttr('data-lazy');
			        }
			}

			lazyInterchange($('#my_element'));
			*/
		});
	});
});