<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<a href="<?php echo esc_url( __( home_url('/about-us/'), 'twentytwelve' ) ); ?>">Tentang Kami</a> | <a href="<?php echo esc_url( __( home_url('/contact-us/'), 'twentytwelve' ) ); ?>">Kontak</a>
		<br>
		v0.1.3 © 2013-2014 <a href="mailto:in%66%6f@hor%6f%6e%67123%2ec%6fm">horong123.com</a>.
		<br>
		All rights reserved.
		<br>
		<!-- <div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			Powered by <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( '%s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div> --> <!-- .site-info -->
		<ul class="footer-social">
			<li><a class="footer-social-facebook" target="blank" href="http://facebook.com/groups/460743870666450/"></a></li>
			<li><a class="footer-social-twitter" target="blank" href="http://twitter.com/horong123"></a></li>
			<li><a class="footer-social-wordpress" target="blank" href="http://wordpress.org"></a></li>
		</ul>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
