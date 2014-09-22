<?
/* Template Name: עמוד ראשי */

wp_register_style('home', get_stylesheet_directory_uri() . '/css/home.css');

wp_enqueue_style('home');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="main-image">
				<?
				the_post_thumbnail()
				?>
			</div>
			<div id="home-middle">
				<div id="home-new-cards" class="decorative-box">
					<h3>
						<span class="title-deco"></span>
						<img src="<?= get_stylesheet_directory_uri() ?>/media/new-cards-deco.png">
						<? _e('New Cards In Repository', THEME_NAME) ?>
					</h3>
					<?

					$args = array(
						'numberposts' => 5,
						'post_status' => implode(', ', Cards::getAllowedStatuses()),
						'post_type' => 'card'
					);

					$cards = wp_get_recent_posts($args);

					foreach($cards as $card) :
						$gender = CardHelpers::get_gender($card);

						if(! $gender)
							continue;

						$currCard = new $gender($card);
						$link = get_permalink($card['ID']);

					?>
						<div class="card-box">
							<a href="<?= $link ?>">
								<img src="<?= WP_CONTENT_URL ?>/themes/matchrepo/media/<?= $currCard -> images['recent_cards']?>">
								<span class="card-excerpt"><?= $currCard -> get_excerpt() ?></span>
							</a>
						</div>

					<? endforeach ?>
				</div>
				<div id="home-content">
					<? the_post() ?>
					<h1><? the_title() ?></h1>
					<? the_content() ?>
				</div>
			</div>

		</main>
		<!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>