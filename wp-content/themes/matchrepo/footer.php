
			</div><!-- #content -->
		</div><!-- #content-wrapper -->
		<div id="footer-top-line">
			<div class="ftl-part" style="width: 5%; background-color: #2962a5"></div>
			<div class="ftl-part" style="width: 15%; background-color: #009a9a"></div>
			<div class="ftl-part" style="width: 25%; background-color: #8c8421"></div>
			<div class="ftl-part" style="width: 15%; background-color: #c14a02"></div>
			<div class="ftl-part" style="width: 20%; background-color: #e3a301"></div>
			<div class="ftl-part" style="width: 10%; background-color: #7c187b"></div>
			<div class="ftl-part" style="width: 10%; background-color: #d6403f"></div>
		</div>
		<div id="footer-wrapper">

			<footer role="contentinfo">
				<div id="site-info">
					<div id="footer-logo">
						<img src="<?= WP_CONTENT_URL ?>/uploads/images/logo-footer.png">
					</div>
					<?
					$navParams = array(
						'theme_location' => 'footer',
						'container_id' => 'footer-menu'
					);

					wp_nav_menu($navParams);
					?>
				</div><!-- .site-info -->
			</footer>
		</div>
	</div><!-- #page -->
<? wp_footer(); ?>

</body>
</html>
