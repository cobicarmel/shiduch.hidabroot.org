<?

$globalProps = [

	'title' => [
		'label' => 'שם פרטי',
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

	'country' => [
		'label' => 'ארץ',
		'options' => [
			'אוסטריה',
			'אוסטרליה',
			'אוקראינה',
			'אורוגוואי',
			'איטליה',
			'איסלנד',
			'אירלנד',
			'אלבניה',
			'אלג\'יריה',
			'אנגולה',
			'אנדורה',
			'אסטוניה',
			'אקוודור',
			'ארגנטינה',
			'ארצות הברית',
			'בולגריה',
			'בוליביה',
			'בלארוס',
			'בלגיה',
			'ברזיל',
			'גאורגיה',
			'גרמניה',
			'דנמרק',
			'דרום אפריקה',
			'הודו',
			'הולנד',
			'הונגריה',
			'ונצואלה',
			'טורקיה',
			'יוון',
			'ישראל',
			'לוקסמבורג',
			'לטביה',
			'ליבריה',
			'ליטא',
			'ליכטנשטיין',
			'מולדובה',
			'מקדוניה',
			'מקסיקו',
			'נורבגיה',
			'נפאל',
			'סין',
			'סלובניה',
			'סלובקיה',
			'ספרד',
			'פולין',
			'פורטוגל',
			'פינלנד',
			'פרגוואי',
			'פרו',
			'צ\'ילה',
			'צ\'כיה',
			'צרפת',
			'קובה',
			'קולומביה',
			'קנדה',
			'קניה',
			'קפריסין',
			'רומניה',
			'רוסיה',
			'שבדיה',
			'שווייץ',
			'תאילנד'
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
		'options' => [
			'בריא לחלוטין',
			'בעיה קלה',
			'בעל מוגבלות'
		],
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
			'ליטאי/ת',
			'ספרדי/ת',
			'חסידי/ת'
		],
		'compare' => 'IN',
		'pattern' => '/^[0-2]$/'
	],

	'children' => [
		'label' => 'מספר ילדים',
		'compare' => '<=',
		'pattern' => function ($str){
			return is_numeric($str = (int) $str) && $str >= 0 && $str <= 30;
		}
	],

	'hasidism' => [
		'label' => 'חסידות',
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
	],

	'disability_details' => [
		'label' => 'פירוט מוגבלות',
		'options' => [
			'לקוי שמיעה',
			'לקוי ראיה',
			'תלוי בזולת',
			'נעזר חלקית',
			'עצמאי',
			'בעיה נפשית',
			'בעיה חברתית'
		]
	],

	'skin' => [
		'label' => 'גוון עור',
		'options' => [
			'בהיר',
			'כהה',
			'נוטה לבהיר',
			'נוטה לכהה'
		],
		'compare' => 'IN',
		'pattern' => '/^[0-3]$/'
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

	'beard' => [
		'label' => 'זקן',
		'options' => [
			'מזוקן',
			'מגולח'
		],
		'compare' => 'IN'
	],

	'yeshiva_k' => [
		'label' => 'ישיבה קטנה'
	],

	'yeshiva_g' => [
		'label' => 'ישיבה גדולה'
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
		'pattern' => '',
		'compare' => 'IN'
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

Male::$props = array_replace_recursive($globalProps, $maleProps);

Male::$labels = $maleLabels;

Female::$props = array_replace_recursive($globalProps, $femaleProps);

Female::$labels = $femaleLabels;