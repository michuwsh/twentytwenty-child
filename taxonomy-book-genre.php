<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">


    <?php

    if ( have_posts() ) {

        while ( have_posts() ) {
            the_post();

            get_template_part( 'template-parts/content', get_post_type() );

        }
    }

    ?>

    <div class="section-inner">
		<?php

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		?>

	</div><!-- .section-inner -->

    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div><!-- .pagination -->

</main><!-- #site-content -->

<?php get_footer(); ?>
