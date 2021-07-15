<?php
/**
 * The default template for displaying content book
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' ); 
    
  
	if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}       
    ?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
            }
            ?>

            <ul class="tt_child_taxonomy">
                <?php echo get_the_term_list( $post->ID, 'book-genre', '<li class="book-genre">', ', ', '</li>' ) ?>      
            </ul><!-- .tt_child_taxonomy -->

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

</article><!-- .post -->
