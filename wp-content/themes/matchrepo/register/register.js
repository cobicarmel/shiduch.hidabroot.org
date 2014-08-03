
var params = {
	name: 'zone',
	event: 'change',
	$toggles: $('#user-country'),
	$affected: $('#user-zone-wrapper'),
	handler: function(data){
		var fn = this[0].value == 'ישראל' ? 'show' : 'hide';

		Toggle.applyDefaultFunction(fn, this, data);
	}
};

Toggle.addToggle(params);