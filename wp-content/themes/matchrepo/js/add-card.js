$(function(){

	$('#cf-birthday').datepicker({
		dateFormat: 'dd/mm/yy',
		isRTL: true,
		dayNames: ['ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת'],
		dayNamesMin: ['א\'', 'ב\'', 'ג\'', 'ד\'', 'ה\'', 'ו\'', 'שבת'],
		monthNames: ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר' ],
		monthNamesShort: ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר' ],
		nextText: 'החודש הבא',
		prevText: 'החודש הקודם',
		changeMonth: true,
		changeYear: true,
		minDate: '-99y',
		maxDate: '-17y',
		yearRange: 'c-99:c'
	});

	var params,
		$toggles = $('.toggle-trigger'),
		$affected = $('.toggle-affected'),
		$showHideTriggers = $toggles.filter('.show-hide-trigger'),
		$showHideAffected = $affected.filter('.show-hide-affected'),
		$hasidismTrigger = $toggles.filter('.hasidism-trigger'),
		$hasidismAffected = $affected.filter('.hasidism-affected'),
		$zoneTrigger = $toggles.filter('.zone-trigger'),
		$zoneAffected = $affected.filter('.zone-affected');

	$showHideTriggers.each(function(index){

		var $this = $showHideTriggers.eq(index),
			key = $this.data('toggleKey'),
			$affectedGroup = $showHideAffected.filter('[data-affected=' + key + ']');

		params = {
			name: 'toggleSH' + index,
			event: 'change',
			$toggles: $this,
			$affected: $affectedGroup,
			handler: function(data){
				var fn = +this.val()  ? 'show' : 'hide';

				Toggle.applyDefaultFunction(fn, this, data);
			}
		};

		Toggle.addToggle(params);
	});

	params = {
		name: 'hasidism',
		event: 'change',
		$toggles: $hasidismTrigger,
		$affected: $hasidismAffected,
		handler: function(data){
			var fn = this.val() == 2 ? 'show' : 'hide';

			Toggle.applyDefaultFunction(fn, this, data);
		}
	};

	Toggle.addToggle(params);

	params = {
		name: 'zone',
		event: 'change',
		$toggles: $zoneTrigger,
		$affected: $zoneAffected,
		handler: function(data){
			var fn = this[0].value == 'ישראל' ? 'show' : 'hide';

			Toggle.applyDefaultFunction(fn, this, data);
		}
	};

	Toggle.addToggle(params);
});