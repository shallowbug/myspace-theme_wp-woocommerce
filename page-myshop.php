<?php get_header(); ?>
<header>
    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Store</a></li>
            <li><a href="">Blog</a></li>
            <li><a href="">Photos</a></li>
            <li><a href="">Instagram</a></li>
            <li><a href="">Playground</a></li>
            <li><a href="">Coffee</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>
</header>

<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>

<?php

    the_title();

    the_post_thumbnail('medium');

    the_content();
    the_field('blurb');

    if( have_rows('header') ):
      while( have_rows('header') ): the_row();
        the_sub_field('blurb');
        the_sub_field('stats');
        the_sub_field('mood');
        endwhile;
    endif;

    if( have_rows('interests') ):
      while( have_rows('interests') ): the_row();
        the_sub_field('general');
        the_sub_field('music');
        the_sub_field('movies');
        the_sub_field('tv');
        the_sub_field('books');
        the_sub_field('heroes');

        endwhile;
    endif;

    if( get_field('details_status') ):
        echo 'DEET:'; the_field('details_status');
    endif;

    if( get_field('details_here') ):
        echo 'HERE:'; the_field('details_here');
    endif;
    the_field('details_hometown');
    the_field('details_ethnicity');
    the_field('details_zodiac');
    the_field('details_smokedrink');
    the_field('details_education');
    the_field('details_occupation');

    $get_posts = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));

    if ( $get_posts -> have_posts() ) :
        while ( $get_posts -> have_posts() ) : $get_posts -> the_post();
            the_permalink();
            the_title();
        endwhile;
    endif;

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            // Display post content
        endwhile;
    endif;

    do_shortcode('[woocommerce_product_filter_products]');

/* Start the Loop */
    while ( have_posts() ) :
        the_post();

        // If comments are open or there is at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    endwhile; // End of the loop.

    ?>


<?php get_footer(); ?>