<?

$globalProps = [

	'age' => [
		'label' => __('Age', THEME_NAME)
	],

	'birthday' => [
		'label' => __('Date Of Birth', THEME_NAME),
		'type' => 'text',
		'pattern' => ''
	],

	'status' => [
		'label' => __('Marital Status', THEME_NAME),
		'type' => 'select',
		'options' => [
			__('Single', THEME_NAME),
			__('Divorcee', THEME_NAME),
			__('Widow', THEME_NAME),
		],
		'attr' => []
	],

	'work' => [
		'label' => __('Work/Learning Place Today', THEME_NAME),
		'type' => 'text'
	],

	'city' => [
		'label' => __('City', THEME_NAME),
		'type' => 'select',
		'options' => []
	],

	'zone' => [
		'label' => __('Zone', THEME_NAME),
		'type' => 'select',
		'options' => [
			'המרכז',
			'ירושלים'
		]
	],

	'look' => [
		'label' => __('View', THEME_NAME),
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
	],

	'min_age' => [
		'label' => __('Min Age', THEME_NAME),
		'type' => 'select',
		'options' => range(18, 99)
	],

	'max_age' => [
		'label' => __('Max Age', THEME_NAME),
		'type' => 'select',
		'options' => range(18, 99)
	],

	'gender' => [
		'label' => __('Looking For', THEME_NAME),
		'type' => 'radio',
		'options' => [
			__('Man', THEME_NAME),
			__('Woman', THEME_NAME)
		]
	],

	'conception' => [
		'label' => __('Conception', THEME_NAME),
		'type' => 'select',
		'options' => [
			'ליטאית',
			'ספרדית',
			'חסידית'
		]
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

$maleLabels = [
	'Little_About_The_Candidate' => _x('Little_About_The_Candidate', 'male', THEME_NAME)
];

$femaleProps = [

	'status' => [
		'options' => [
			'רווקה',
			'גרושה',
			'אלמנה'
		]
	],

	'community' => [
		'options' => [
			'אשכנזיה',
			'ספרדיה',
			'תמניה'
		]
	],

	'cover' => [
		'label' => __('Cover', THEME_NAME),
		'type' => 'bool'
	]
];

$femaleLabels = [
	'Little_About_The_Candidate' => _x('Little_About_The_Candidate', 'female', THEME_NAME)
];

Cards::$props = $globalProps;

Male::$props = array_merge_recursive($maleProps, $globalProps);

Male::$labels = $maleLabels;

Female::$props = array_merge_recursive($femaleProps, $globalProps);

Female::$labels = $femaleLabels;