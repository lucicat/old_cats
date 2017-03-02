"use strict";
$( document ).ready(() => {
	let loginFormClose = true;
	$('.close-login-form').click((event) => {
		if (loginFormClose == false) {
			$('#login_form').css('display', 'none');
			loginFormClose = true;
		}
	});
	$('.login').click((event) => {
		if (loginFormClose == true) {
			$('#login_form').css('display', 'flex');
			loginFormClose = false;
		}
	});
});