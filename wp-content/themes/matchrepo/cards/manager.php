<?
add_action('after_setup_theme', function(){

	require __DIR__ . '/cards.class.php';

	require __DIR__ . '/cardHelpers.class.php';

	require __DIR__ . '/properties.php';

	require __DIR__ . '/register.php';
});
