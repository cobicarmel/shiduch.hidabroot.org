<?

/*
Template Name: החשבון שלי
*/

use Matchrepo\QueryResponse;

Matchrepo::redirect_not_logged();

Matchrepo::multiCardsHeader();

add_action('wp_enqueue_scripts', function () {

    wp_enqueue_script('account-search');
});

get_header();

$paged = get_query_var('paged', 1);

$user_id = $current_user->ID;

$args = array(
    'author' => $user_id,
    'post_type' => 'card',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'posts_per_page' => 10,
    'paged' => $paged,
    'post_status' => ['publish', 'private'],
    'meta_query' => []
);

if (isset($_GET['title'])) {

    add_filter('posts_where', function ($where) {

        global $wpdb;

        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql($_GET['title']) . '%\'';

        return $where;
    });
}

$meta_query = ['last_name', 'origins'];

foreach ($meta_query as $meta) {

    if (!empty($_GET[$meta])) {
        $args['meta_query'][] = [
            'key' => $meta,
            'value' => $_GET[$meta]
        ];
    }
}

query_posts($args);

$found_posts = $wp_query->found_posts;

$isSearch = false;

try {
    array_walk($_GET, function ($value) {

        if ($value)
            throw new Exception;
    });
} catch (Exception $e) {
    $isSearch = true;
}

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div id="user-managing">
            <a href="<?= get_permalink(get_page_by_title('הוספת כרטיס')) ?>">
                <button><? _e('Add New Card', THEME_NAME) ?></button>
            </a>
            <a href="<?= get_permalink(get_page_by_title('ניהול חשבון')) ?>">
                <button><? _e('Account Managing', THEME_NAME) ?></button>
            </a>
            <button id="my-account-search-button"><? _e('Search') ?></button>
            <!--<button><? /* _e('Email Notifications Settings', THEME_NAME) */ ?></button>-->
        </div>
        <? QueryResponse::listResponse() ?>
        <div id="account-search"<?= $isSearch ? null : ' style="display: none"' ?>>
            <form>
                <input name="title" placeholder="שם פרטי" value="<?= @ $_GET['title'] ?>">
                <input name="last_name" placeholder="שם משפחה" value="<?= @ $_GET['last_name'] ?>">
                <select name="origins">
                    <option disabled selected>עדה</option>
                    <? Matchrepo::listOptions(Cards::$props['origins']['options'], @ $_GET['origins'], true)?>
                </select>
                <input type="submit" value="<? _e('Search') ?>">
            </form>
        </div>

        <div id="user-crumbs">
            <?
            if ($isSearch) {

                printf('נמצאו %d כרטיסים בחיפוש', $found_posts);

                ?>
                <a id="ma-clear-search" href="<? the_permalink() ?>">נקה חיפוש</a>
            <?
            } else
                printf(__('Hello %s, there are %d cards in your account', THEME_NAME), $current_user->display_name, $found_posts)
            ?>
        </div>
        <div class="background-area">
            <?

            while (have_posts()) : the_post(); ?>

                <? get_template_part('content', 'account'); ?>

            <? endwhile ?>

            <? Matchrepo::multiCardsNavigation() ?>
        </div>
    </main>
    <!-- #main -->
</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>
