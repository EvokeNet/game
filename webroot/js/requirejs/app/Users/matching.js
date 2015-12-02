require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','jqueryui'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Checkbox glows when selected
			//--------------------------------------------//
			$("input[type=checkbox]").on( "click", function(){
				if ($(this).hasClass('img-glow-small')) {
					$(this).removeClass('img-glow-small');
					$("label[for='"+$(this).attr("id")+"']").removeClass('text-glow');
				}
				else {
					$(this).addClass('img-glow-small');
					$("label[for='"+$(this).attr("id")+"']").addClass('text-glow');
				}
			});

			$("#sendAnswers").on("click", function(){
				$('a.close-reveal-modal').trigger('click');
			});

			$(".nextQuestion").on("click", function(){
				// fake a submition to trigger foundation abide validation
				$('#questionsForm').trigger('submit');

				
			});


			$('#questionsForm')
		  		.on('invalid', function () {
		  			console.log('invalid!');
		    		if( $('div[class|="field"]:not(.hidden)').find('[data-invalid]').length == 0){
		    			$('div[class|="field"]:not(.hidden)').addClass('hidden').next().removeClass('hidden');
		    			$('small.error').css('display', 'none');
		    			
		    			var counter = $('#questionCounter').text();
						var total   = parseFloat($('#totalQuestions').text());
						
						// change question counter
						$('#questionCounter').html(++counter);
						// increase progress bar
						$('#questionsModal .meter').css('width', (parseFloat(counter-1)/total*100)+'%');
		    		}else{
		    			$('small.error').css('display', 'block');
		    		}
		  		})
		  		.on('valid', function () {
		  			$('div[class|="field"]:not(.hidden)').addClass('hidden').next().removeClass('hidden');
		  			
		  			var counter = $('#questionCounter').text();
					var total   = parseFloat($('#totalQuestions').text());
					
					// change question counter
					$('#questionCounter').html(++counter);
					// increase progress bar
					$('#questionsModal .meter').css('width', (parseFloat(counter-1)/total*100)+'%');
		    		console.log('valid!');
		  	});
			//--------------------------------------------//
			//Sortable list with drag and drop effect
			//--------------------------------------------//
			$(function() {
			    $( ".sortable" ).sortable({
			    	stop: function( event, ui ) {
			        	var ul = $(ui.item[0]).parent();
			       		ul.find('li:not(.ui-sortable-placeholder)').each(function( index, element ) {
			        		var inputName = $(element).data('sort');
			          		//console.log($(this).parent().parent().find('input[data-answer-id="' + inputName + '"]'));
			        		$(this).parent().parent().find('input[data-answer-id="' + inputName + '"]').attr('value', index+1);
			        	}); 
			      	}  
				});
				$( ".sortable" ).disableSelection();
			});
		});
	});
});