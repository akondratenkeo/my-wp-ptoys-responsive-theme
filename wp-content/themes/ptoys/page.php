<?php
/**
 * The template for displaying pages
 */

get_header(); ?>

<div id="content-area" class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <main id="main" class="site-main" role="main">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                        // Include the page content template.
                        get_template_part( 'template-parts/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }

                        // End of the loop.
                    endwhile;
                    ?>
	            </main>
            </div>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
