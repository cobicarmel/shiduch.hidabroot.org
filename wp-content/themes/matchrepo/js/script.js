'use strict';

window.$ = jQuery;

$(function(){
	$('.search-form').on('submit', submitForm);
});

function submitForm(){

	var $form = $(this);

	$form.find(':input').filter(function(){
		return this.value === '';
	}).prop('disabled', true);
}