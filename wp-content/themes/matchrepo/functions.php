<?

define('THEME_NAME', 'Matchrepo');

require STYLESHEETPATH . '/actions/class.actions.php';

require STYLESHEETPATH . '/filters/class.filters.php';

require STYLESHEETPATH . '/widgets/banner.php';

require STYLESHEETPATH . '/cards/manager.php';

require STYLESHEETPATH . '/init/register.php';

require STYLESHEETPATH . '/init/sidebars.php';

require STYLESHEETPATH . '/inc/Matchrepo.class.php';

require STYLESHEETPATH . '/inc/QueryResponse.class.php';

require STYLESHEETPATH . '/acf/fields.php';

if(IS_LOCAL)
	require STYLESHEETPATH . '/framework/init/init.php';