"use strict";
$( document ).ready(() => {
	let DomSlider = $('.polzunok');
	
	// initialize slider
	DomSlider.slider({
		animate: "slow",
		max: 10,
		min: 1,
		range: true,
		step: 1,
		values: [1,10],
	});
	

	let polzunks = $('.ui-slider-handle.ui-corner-all.ui-state-default');
	
	// remove fucking line
	$('.ui-slider-range.ui-corner-all.ui-widget-header').css('display','none');
	// add style for our polzunks 
	polzunks.css({
		'font-size': '.7em',
		'padding':'5px 4px 3px 4px',
		'outline':'none',
		'box-sizing': 'content-box',
		'text-align':'center',
	});
	
	// set event for change place polzunks
	let inputFrom = $('#weight_from');
	let inputTo = $('#weight_to');

	let oldValueFrom = inputFrom.val();
	let oldValueTo = inputTo.val();
	if (oldValueFrom == false && oldValueTo == false) {
		inputFrom.val('1');
		inputTo.val('10');
		// add starting value for polzunks 
		polzunks.first().append('1');
		polzunks.last().append('10');
	} else {
		DomSlider.slider('option', 'values', [oldValueFrom, oldValueTo]);
		polzunks.last().append(oldValueTo);
		polzunks.first().append(oldValueFrom);
	}


	
	DomSlider.slider({
		change: function( event, ui ) {
			let values = DomSlider.slider('values');
			polzunks.first().html(values[0]);
			polzunks.last().html(values[1]);
			inputFrom.val(values[0]);
			inputTo.val(values[1]);
		}
	});


	////////////////////////
	// for ajax
	// set events handler for our
	// inputs
	 // let namecat = $('input[name=name]');
	 // let sexcat = $('input[type=radio]');
	 // let fromage = $('input[name=from_age]');
	 // let toage = $('input[name=to_age]');
	 // let breedcat = $('select[name=breed-cat]');
	 // let submit = $('input[type=submit]');

	 // namecat.focusout(function(event) {
	 // 	 act on the event 
	 // });

	 // sexcat.click(function(event) {
	 // 	/* act on the event */
	 // });

	 // fromage.focusout(function(event) {
	 // 	/* act on the event */
	 // });

	 // toage.focusout(function(event) {
	 // 	/* act on the event */
	 // });

	 // breedcat.change(function(event) {
	 // 	/* act on the event */
	 // });
});