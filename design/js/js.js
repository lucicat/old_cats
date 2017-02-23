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
	// add starting value for polzunks 
	polzunks.first().append('1');
	polzunks.last().append('10');
	// set event for change place polzunks
	DomSlider.slider({
		change: function( event, ui ) {
			let values = DomSlider.slider('values');
			polzunks.first().html(values[0]);
			polzunks.last().html(values[1]);
			console.log(DomSlider.slider("values"));
		}
	});
	////////////////////////
	// set events handler for our
	// inputs
	 let nameCat = $('input[name=name]');
	 let sexCat = $('input[type=radio]');
	 let fromAge = $('input[name=from_age]');
	 let toAge = $('input[name=to_age]');
	 let breedCat = $('select[name=breed-cat]');
	 let submit = $('input[type=submit]');

	 nameCat.focusout(function(event) {
	 	/* Act on the event */
	 });

	 sexCat.click(function(event) {
	 	/* Act on the event */
	 });

	 fromAge.focusout(function(event) {
	 	/* Act on the event */
	 });

	 toAge.focusout(function(event) {
	 	/* Act on the event */
	 });

	 breedCat.change(function(event) {
	 	/* Act on the event */
	 });
});