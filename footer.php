	</main><!-- #content -->
	<?php render_view( 'footer.twig', [
		'year' => date('Y'),
		'homeUrl' => home_url(),
		'blogName' => get_bloginfo( 'name' ),
	] ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
