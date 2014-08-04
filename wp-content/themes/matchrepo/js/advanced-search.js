$(function(){

	/** TOGGLE TRIGGERS  **/

	var $triggers = $('.toggle-trigger'),
		$affectedGroups = $('.toggle-affected-group');

	/* Check/uncheck triggers */

	var $selectAll = $triggers.filter('.select-all');

	$selectAll.each(function(index){

		var $currentSelect = $selectAll.eq(index),
			key = $currentSelect.data('toggleKey'),
			$checkGroup = $affectedGroups.filter('[data-check-group=' + key + ']').find('input');

		var params = [
			{
				name: 'checkAll' + index,
				event: 'change',
				$toggles: $currentSelect,
				$affected: $checkGroup,
				handler: function(data){
					Toggle.applyDefaultFunction('checkAll', this, data);
				}
			},
			{
				name: 'UnCheckAll' + index,
				event: 'change',
				$toggles: $checkGroup,
				$affected: $currentSelect,
				handler: function(data){
					Toggle.applyDefaultFunction('unCheckAll', this, data);
				}
			}
		];

		Toggle.addToggle(params);
	});

	/* Labels replaces triggers */

	var $replaceTriggers = $triggers.filter('.labels-replace-trigger'),
		triggersCount = 0;

	var texts = {

		status: {
			male: [
				'רווק',
				'גרוש',
				'אלמן'
			],
			female: [
				'רווקה',
				'גרושה',
				'אלמנה'
			]
		},

		community: {
			male: [
				'אשכנזי',
				'ספרדי',
				'תימני'
			],
			female: [
				'אשכנזיה',
				'ספרדיה',
				'תימניה'
			]
		},

		conception: {
			male: [
				'ליטאי',
				'ספרדי',
				'חסידי'
			],
			female: [
				'ליטאית',
				'ספרדיה',
				'חסידית'
			]
		}
	};

	$replaceTriggers.each(function(index){

		var $currentTrigger = $replaceTriggers.eq(index),
			key = $currentTrigger.data('toggleKey'),
			$labelsGroup = $affectedGroups.filter('[data-labels=' + key + ']');

		for(var text in texts) {

			var params = {
				name: 'replaceText' + triggersCount++,
				event: 'change',
				$toggles: $currentTrigger.find('input'),
				$affected: $labelsGroup.filter('[data-labels-group=' + text + ']').find('label'),
				handler: function(text){
					return function(data){
						Toggle.applyDefaultFunction('labelsText', this, data, text);
					}
				}(texts[text])
			};

			Toggle.addToggle(params);
		}
	});

	/* Show/hide triggers */

	var $showHideTriggers = $triggers.filter('.show-hide-trigger');

	$showHideTriggers.each(function(index){

		var iterations = ['show', 'hide'];

		for(var i in iterations) {

			var action = iterations[i];

			var $currentTrigger = $showHideTriggers.eq(index),
				key = $currentTrigger.data('toggleKey'),
				$displayGroups = $affectedGroups.filter('[data-' + action + '=' + key + ']');

			var params = {
				name: action + index,
				event: 'change',
				$toggles: $currentTrigger,
				$affected: $displayGroups,
				handler: function(action){
					return function(data){
						Toggle.applyDefaultFunction(action, this, data);
					}
				}(action)
			};

			Toggle.addToggle(params);
		}
	});

	var $switchTriggers = $triggers.filter('.switch-trigger');

	$switchTriggers.each(function(index){

		var $currentTrigger = $switchTriggers.eq(index),
			key = $currentTrigger.data('toggleKey'),
			$displayGroups = $affectedGroups.filter('[data-affected=' + key + ']');

		var params = {
			name: 'switch' + index,
			event: 'change',
			$toggles: $currentTrigger,
			$affected: $displayGroups,
			handler: function(data){

				var operators = {
					'==': function(a, b){
						return a == b;
					},
					'!=': function(a, b){
						return a != b;
					},
					'in': function(a, b){
						return b.split(',').map(function(str){
							return str.trim();
						}).indexOf(a) > -1;
					}
				};

				var selectData = this.data(),
					compare = selectData.compare || '==',
					param = selectData.param;

				Toggle.applyDefaultFunction(operators[compare](this[0].value, param) ? 'show' : 'hide', this, data);
			}
		};

		Toggle.addToggle(params);
	});

	/* Custom toggles */

	var params = {
		name: 'toggleChildren',
		event: 'change',
		$toggles: $('.maybe-children'),
		$affected: $('#as-children-container'),
		handler: function(data){
			var fn = data.$toggles.filter(':checked').length ? 'show' : 'hide';

			Toggle.applyDefaultFunction(fn, this, data);
		}
	};

	Toggle.addToggle(params);
});