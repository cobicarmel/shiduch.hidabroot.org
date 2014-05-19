<?

$globalProps = [

	'birthday' => [
		'label' => __('Date Of Birth', THEME_NAME),
		'type' => 'text',
		'pattern' => ''
	],

	'status' => [
		'label' => 'Marital Status',
		'type' => 'select',
		'options' => [],
		'attr' => []
	],

	'work' => [
		'label' => __('Work/Learning Place Today', THEME_NAME),
		'type' => 'text'
	],

	'city' => [
		'label' => __('City'),
		'type' => 'select',
		'options' => []
	],

	'look' => [
		'label' => __('General Look'),
		'type' => 'select',
		'options' => []
	],

	'community' => [
		'label' => __('Community', THEME_NAME),
		'type' => 'select',
		'options' => [
			'אשכנזי',
			'ספרדי',
			'תמני'
		]
	],

	'height' => [
		'label' => __('Height', THEME_NAME),
		'type' => 'number'
	],

	'father_work' => [
		'label' => __('Father Work', THEME_NAME),
		'type' => 'text'
	],

	'mother_work' => [
		'label' => __('Mother Work', THEME_NAME),
		'type' => 'text'
	],

	'healthy' => [
		'label' => __('Healthy', THEME_NAME),
		'type' => 'select',
		'options' => []
	]
];

$maleProps = [

	'status' => [
		'options' => [
			'רווק',
			'גרוש',
			'אלמן'
		]
	],

	'smoking' => [
		'label' => __('Smoking', THEME_NAME),
		'type' => 'bool'
	]
];

$femaleProps = [

	'status' => [
		'options' => [
			'רווקה',
			'גרושה',
			'אלמנה'
		]
	],

	'cover' => [
		'label' => __('Cover', THEME_NAME),
		'type' => 'bool'
	]
];

Male::$props = array_merge($globalProps, $maleProps);

Female::$props = array_merge($globalProps, $femaleProps);