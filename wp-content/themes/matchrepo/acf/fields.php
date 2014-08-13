<?

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'card_details',
		'title' => 'פרטי כרטיס',
		'fields' => array (
			array (
				'key' => 'field_539a56d552cf5',
				'label' => 'מין',
				'name' => 'gender',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					0 => 'גבר',
					1 => 'אישה',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a57a9b7588',
				'label' => 'תאריך לידה',
				'name' => 'birthday',
				'type' => 'date_picker',
				'required' => 1,
				'date_format' => 'yy-mm-dd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 0,
			),
			array (
				'key' => 'field_539a585318049',
				'label' => 'מצב משפחתי',
				'name' => 'status',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['status']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a58951804b',
				'label' => 'מצב משפחתי',
				'name' => 'status',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Female::$props['status']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a58c01804c',
				'label' => 'מספר ילדים',
				'name' => 'children',
				'type' => 'number',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a585318049',
							'operator' => '!=',
							'value' => '0',
						),
						array (
							'field' => 'field_539a58951804b',
							'operator' => '!=',
							'value' => '0',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 20,
				'step' => 1,
			),
			array (
				'key' => 'field_539a599ffcf54',
				'label' => 'מוצא עדתי',
				'name' => 'community',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['community']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a59f9fcf55',
				'label' => 'מוצא עדתי',
				'name' => 'community',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Female::$props['community']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5a20fcf56',
				'label' => 'השקפה',
				'name' => 'conception',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['conception']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5a4efcf57',
				'label' => 'השקפה',
				'name' => 'conception',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Female::$props['conception']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5aa6d451d',
				'label' => 'עיסוק',
				'name' => 'work',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_539a5ac8d451e',
				'label' => 'ישיבה קטנה',
				'name' => 'yeshiva_k',
				'type' => 'text',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_549a5ac8d451e',
				'label' => 'ישיבה גדולה',
				'name' => 'yeshiva_g',
				'type' => 'text',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_549a5a20fcf56',
				'label' => 'עיסוק',
				'name' => 'practice',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['practice']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a66ca052d1',
				'label' => 'סמינר',
				'name' => 'college',
				'type' => 'text',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_539a5b05d451f',
				'label' => 'עיסוק האב',
				'name' => 'father_work',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_539a5b26d4520',
				'label' => 'עיסוק האם',
				'name' => 'mother_work',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_539a5b443b9a8',
				'label' => 'עישון',
				'name' => 'smoke',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'מעשן',
				'default_value' => 0,
			),
			array (
				'key' => 'field_539a5bc1576a8',
				'label' => 'גובה',
				'name' => 'height',
				'type' => 'number',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 120,
				'max' => 210,
				'step' => '',
			),
			array (
				'key' => 'field_539a5bdd576a9',
				'label' => 'מראה כללי',
				'name' => 'look',
				'type' => 'select',
				'required' => 1,
				'choices' => Cards::$props['look']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_540a5bdd576a9',
				'label' => 'גוון עור',
				'name' => 'skin',
				'type' => 'select',
				'required' => 1,
				'choices' => Cards::$props['skin']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5c14576aa',
				'label' => 'מצב בריאותי',
				'name' => 'healthy',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['healthy']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5c91576ab',
				'label' => 'מצב בריאותי',
				'name' => 'healthy',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Female::$props['healthy']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5cd4320ce',
				'label' => 'פירוט מוגבלות',
				'name' => 'disability_details',
				'type' => 'checkbox',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
						array (
							'field' => 'field_539a5c14576aa',
							'operator' => '!=',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['disability_details']['options'],
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_539a5dfc320cf',
				'label' => 'פירוט מוגבלות',
				'name' => 'disability_details',
				'type' => 'checkbox',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_539a5c91576ab',
							'operator' => '!=',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Female::$props['disability_details']['options'],
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_53c93f2ad7ac6',
				'label' => 'מוגבלות אחרת',
				'name' => 'other_disability',
				'type' => 'textarea',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a5c14576aa',
							'operator' => '!=',
							'value' => '0',
						),
						array (
							'field' => 'field_539a5c91576ab',
							'operator' => '!=',
							'value' => '0',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_539a5e4587be5',
				'label' => 'ארץ מגורים',
				'name' => 'country',
				'type' => 'select',
				'required' => 1,
				'choices' => array_combine(Cards::$props['country']['options'], Cards::$props['country']['options']),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_539a5e9787be7',
				'label' => 'אזור מגורים',
				'name' => 'zone',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a5e4587be5',
							'operator' => '==',
							'value' => 'ישראל',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array_combine(Cards::$props['zone']['options'], Cards::$props['zone']['options']),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53a625d31a8a0',
				'label' => 'כיסוי ראש',
				'name' => 'cover',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Female::$props['cover']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54a625d31a8a0',
				'label' => 'זקן',
				'name' => 'beard',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a56d552cf5',
							'operator' => '==',
							'value' => '0',
						),
					),
					'allorany' => 'all',
				),
				'choices' => Male::$props['beard']['options'],
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53a6bee458e15',
				'label' => 'חסידות',
				'name' => 'hasidism',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_539a5a20fcf56',
							'operator' => '==',
							'value' => '2',
						),
						array (
							'field' => 'field_539a5a4efcf57',
							'operator' => '==',
							'value' => '2',
						),
					),
					'allorany' => 'any',
				),
				'choices' => array_combine(Cards::$props['hasidism']['options'], Cards::$props['hasidism']['options']),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'card',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}