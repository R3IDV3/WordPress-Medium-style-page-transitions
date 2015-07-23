<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<section class="post-content">
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			</section><!-- .post-content -->
		</main><!-- #main -->
			
			<?php
				$prev_post = get_previous_post();
				if (!empty( $prev_post )): 
			?>
				
				<div id="next" class="content-hidden" data-post-id="<?php echo $prev_post->ID ?>">
					<article id="post-<?php echo $prev_post->ID ?>">
						
						<div id="featured-image" class="post-thumbnail">
							<div class="read-next">
								<p>Read Next</p>
								<h1 class="entry-title"><?php echo $prev_post->post_title ?></h1>
							</div><!-- .read-next -->
							<?php echo get_the_post_thumbnail($prev_post->ID); ?>
						</div><!-- .post-thumbnail -->
						
						<div class="article-content post-content">
							<header class="entry-header">
								<h1 class="entry-title"><?php echo $prev_post->post_title ?></h1>
						
								<div class="entry-meta">
									<?php get_date_and_author($prev_post) ?>
								</div><!-- .entry-meta -->
							</header><!-- .entry-header -->
						
							<div class="entry-content">
								<?php echo apply_filters('the_content', $prev_post->post_content); ?>
							</div><!-- .entry-content -->
						</div><!-- .article-content -->
					</article><!-- #post-## -->
				</div> <!-- #next -->
				
				<?php endif; ?>
				
		<?php endwhile; // End of the loop. ?>
		
	</div><!-- #primary -->
</div><!-- #content -->
</div><!-- noscroll wrapper -->
</div><!-- #page -->


<?php
function get_date_and_author($prev_post) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U', $prev_post ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'F j, Y', $prev_post->ID ) ),
		esc_html( get_the_date('F j, Y', $prev_post->ID) ),
		esc_attr( get_the_modified_date( 'F j, Y' ) ),
		esc_html( get_the_modified_date( 'F j, Y' ) )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date' ),
		'<a href="' . esc_url( get_permalink($prev_post->ID) ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $prev_post->post_author ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $prev_post->post_author ) ) . '</a></span>'
	);
	
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
?>

<?php wp_footer(); ?>

</body>
</html>