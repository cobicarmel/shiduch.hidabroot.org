<?

$globalProps = [

	'title' => [
		'label' => __('First Name', THEME_NAME),
		'pattern' => '/^[a-zא-ת| ]+$/'
	],

	'age' => [
		'label' => __('Age', THEME_NAME)
	],

	'birthday' => [
		'label' => __('Date Of Birth', THEME_NAME),
		'type' => 'text',
		'pattern' => function ($str){
			if(!$date = DateTime::createFromFormat('d/m/Y', $str))
				return false;

			$dateParams = explode('-', $date->format('m-d-Y'));

			return checkdate($dateParams[0], $dateParams[1], $dateParams[2]);
		}
	],

	'status' => [
		'label' => __('Marital Status', THEME_NAME),
		'type' => 'select',
		'options' => [
			__('Single', THEME_NAME),
			__('Divorcee', THEME_NAME),
			__('Widow', THEME_NAME),
		],
		'attr' => [],
		'compare' => 'IN',
		'pattern' => '/^[0-2]$/'
	],

	'work' => [
		'label' => __('Work/Learning Place Today', THEME_NAME),
		'type' => 'text'
	],

	'city' => [
		'label' => __('City', THEME_NAME),
		'type' => 'select',
		'options' => [
			'ירושלים',
			'בני ברק',
			'תל אביב',
			'חיפה'
		]
	],

	'zone' => [
		'label' => __('Zone', THEME_NAME),
		'type' => 'select',
		'options' => [
			'אזור הצפון',
			'אזור המרכז',
			'אזור הדרום',
			'אזור השרון והשפלה',
			'ירושלים והסביבה'
		],
		'termByValue' => true,
		'compare' => 'IN'
	],

	'look' => [
		'label' => __('View', THEME_NAME),
		'type' => 'select',
		'options' => [
			'מבנה רזה',
			'מבנה בינוני',
			'מבנה מלא'
		],
		'compare' => 'IN',
		'pattern' => '/^[0-2]$/'
	],

	'community' => [
		'label' => __('Community', THEME_NAME),
		'type' => 'select',
		'options' => [
			'אשכנזי',
			'ספרדי',
			'תימני'
		],
		'compare' => 'IN',
		'pattern' => '/^[0-2]$/'
	],

	'height' => [
		'label' => __('Height', THEME_NAME),
		'type' => 'number',
		'pattern' => function ($str){
			return is_numeric($str = (int) $str) && $str >= 100 && $str <= 240;
		}
	],

	'min_height' => [
		'label' => __('Min Height', THEME_NAME),
		'type' => 'select',
		'options' => range(120, 210),
		'compare' => '>=',
		'queryKey' => 'height',
		'queryType' => 'DECIMAL'
	],

	'max_height' => [
		'label' => __('Max Height', THEME_NAME),
		'type' => 'select',
		'options' => range(120, 210),
		'compare' => '<=',
		'queryKey' => 'height',
		'queryType' => 'DECIMAL'
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
		'options' => [],
		'pattern' => '/^[0-2]$/'
	],

	'min_age' => [
		'label' => __('Min Age', THEME_NAME),
		'type' => 'select',
		'options' => range(18, 99),
		'termByValue' => true,
		'queryKey' => 'birthday',
		'queryValue' => function ($value){
			return date('Y-m-d', strtotime("-$value year"));
		},
		'compare' => '<'
	],

	'max_age' => [
		'label' => __('Max Age', THEME_NAME),
		'type' => 'select',
		'options' => range(18, 99),
		'termByValue' => true,
		'queryKey' => 'birthday',
		'queryValue' => function ($value){
			return date('Y-m-d', strtotime("-$value year"));
		},
		'compare' => '>'
	],

	'gender' => [
		'label' => __('Looking For', THEME_NAME),
		'type' => 'radio',
		'options' => [
			__('Man', THEME_NAME),
			__('Woman', THEME_NAME)
		],
		'compare' => '=',
		'pattern' => '/^[0-1]$/'
	],

	'conception' => [
		'label' => __('Conception', THEME_NAME),
		'type' => 'select',
		'options' => [
			'ליטאית',
			'ספרדית',
			'חסידית'
		],
		'compare' => 'IN',
		'pattern' => '/^[0-2]$/'
	],

	'children' => [
		'compare' => '<=',
		'pattern' => function ($str){
			return is_numeric($str = (int) $str) && $str >= 0 && $str <= 30;
		}
	],

	'hasidism' => [
		'options' => [
			'אשלג',
			'בעלז',
			'ברסלב',
			'גור',
			'ויז\'ניץ',
			'חב"ד',
			'לעלוב',
			'מודז\'יץ',
			'סלונים',
			'צאנז',
			'קרלין',
			'שומר אמונים',
			'תולדות אהרון'
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

	'conception' => [
		'options' => [
			'ליטאי',
			'ספרדי',
			'חסידי'
		]
	],

	'smoke' => [
		'label' => __('Smoking', THEME_NAME),
		'type' => 'bool',
		'options' => [
			'לא מעשן',
			'מעשן'
		],
		'pattern' => ''
	],

	'healthy' => [
		'options' => [
			'בריא לחלוטין',
			'בעיה קלה',
			'בעל מוגבלות'
		]
	],

	'disability_details' => [
		'options' => [
			'לקוי שמיעה',
			'לקוי ראיה',
			'תלוי בזולת',
			'נעזר חלקית',
			'עצמאי',
			'בעיה נפשית',
			'בעיה חברתית'
		]
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

	'conception' => [
		'options' => [
			'ליטאית',
			'ספרדית',
			'חסידית'
		]
	],

	'cover' => [
		'label' => __('Cover', THEME_NAME),
		'type' => 'bool',
		'options' => [
			'פאה בלבד',
			'מטפחת בלבד',
			'פאה ומטפחת'
		],
		'pattern' => ''
	],

	'healthy' => [
		'options' => [
			'בריאה לחלוטין',
			'בעיה קלה',
			'בעלת מוגבלות'
		]
	],

	'disability_details' => [
		'options' => [
			'לקוית שמיעה',
			'לקוית ראיה',
			'תלויה בזולת',
			'נעזרת חלקית',
			'עצמאית',
			'בעיה נפשית',
			'בעיה חברתית'
		]
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