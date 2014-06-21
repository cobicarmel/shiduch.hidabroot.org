'use strict';

var Toggle = {

	currentKey: null,

	$currentAffected: null,

	$currentToggle: null,

	applyDefaultFunction: function(functionName, $toggle, toggle, params){

		this.currentKey = $toggle.data('toggleKey');

		this.$currentToggle = $toggle;

		this.$currentAffected = toggle.$affected;

		var fn = Toggle.defaultFunctions[functionName];

		if(typeof fn != 'function')
			throw new ReferenceError('The Toggle function "' + functionName + '" doesn\'t exist.');

		Toggle.defaultFunctions[functionName].call(this, params, toggle);
	},

	defaultFunctions: {

		labelsText: function(labelValues){

			var labels = labelValues[this.currentKey];

			for(var i in labels)
				this.$currentAffected.eq(i).text(labels[i]);
		},

		checkAll: function(){
			var isChecked = this.$currentToggle.is(':checked');

			this.$currentAffected.prop('checked', isChecked).change();
		},

		hide: function(){
			this.$currentAffected.hide().find(':input').prop('disabled', true);
		},

		show: function(){
			this.$currentAffected.show().find(':input').prop('disabled', false);
		},

		unCheckAll: function(n, toggle){
			var isChecked = this.$currentToggle.is(':checked');

			if(!isChecked)
				this.$currentAffected.prop('checked', false);
			else{
				var allSelected = true;

				toggle.$toggles.each(function(index){
					if(!toggle.$toggles.eq(index).is(':checked'))
						allSelected = false;
				});

				this.$currentAffected.prop('checked', allSelected);
			}
		}
	},

	toggleComponents: ['$affected', '$toggles', 'event', 'handler', 'before'],

	toggles: {},

	addToggle: function(data){

		if(!$.isArray(data))
			data = [data];

		for(var i in data){

			var args = data[i];

			if(this.toggles[args.name])
				throw 'Can NOT create toggle, the toggle "' + args.name + '" already exist.';

			var toggle = this.toggles[args.name] = {};

			for(var component in this.toggleComponents){

				var componentName = this.toggleComponents[component];

				toggle[componentName] = args[componentName];
			}

			this.bindEvent(args.name);
		}
	},

	bindEvent: function(toggleName){

		var toggle = this.toggles[toggleName];

		toggle.$toggles.on(toggle.event, function(){

			var $this = $(this),
				toggleData = $.extend({}, toggle);

			if(typeof toggleData.$affected == 'function')
				toggleData.$affected = toggleData.$affected.call($this, toggleData);

			if(typeof toggleData.before != 'function' || toggleData.before.call($this, toggleData) !== false)
				toggleData.handler.call($this, toggleData);
		});
	}
};

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
				'חסידי'
			],
			female: [
				'אשכנזיה',
				'ספרדיה',
				'חסידית'
			]
		}
	};

	$replaceTriggers.each(function(index){

		var $currentTrigger = $replaceTriggers.eq(index),
			key = $currentTrigger.data('toggleKey'),
			$labelsGroup = $affectedGroups.filter('[data-labels=' + key + ']');

		for(var text in texts){

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

		for(var i in iterations){

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