<?php 
    
    get_header();

    the_title();

    the_post_thumbnail('medium');

    the_content();

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            // Display post content
        endwhile;
    endif;

/* Start the Loop */
    while ( have_posts() ) :
        the_post();

        // If comments are open or there is at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    endwhile; // End of the loop.

    get_footer(); 
?>