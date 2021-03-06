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