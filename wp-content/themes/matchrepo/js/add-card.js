
$(function(){
	$('#nc-birthday').datepicker({
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
});