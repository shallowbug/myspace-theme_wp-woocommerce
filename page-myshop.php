<?php get_header(); ?>

<?php get_template_part( 'templates/partials/header-myshop' ); ?>

<div class="flex flex-col">
    <div id="profileHeader" class="flex flex-row">
        <div id="profilePic" class="flex flex-col">
            <?php the_title(); ?>
            <?php the_post_thumbnail('medium'); ?>
            <span id="mood" class="inline-block"><b>Mood:</b> <?php get_field('header_mood') ? the_field('header_mood') : null ;?></span>

        </div>
        <div id="profileBlurb" class="flex flex-col">
            <?php ?>
            <?php ?>
            <?php ?>
        </div>
    </div>


</div>
<script>
    // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the URL to fetch
        var url = 'https://letterboxd.com/shallowbug/films/diary/by/entry-rating/';

        // Configure the request
        xhr.open('GET', url, true);

        // Set up a function to handle the response
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parse the HTML content
                var parser = new DOMParser();
                var doc = parser.parseFromString(xhr.responseText, 'text/html');

                // Find the "film-table" element
                var filmTable = doc.querySelector('.film-table');

                // Initialize a counter to keep track of the number of items extracted
                var count = 0;

                // Iterate through the "headline-3" elements inside "film-table"
                var headlines = filmTable.querySelectorAll('.headline-3');
                for (var i = 0; i < headlines.length; i++) {
                    // Extract the text from each element
                    var text = headlines[i].textContent;

                    // Display the text on your webpage
                    var resultDiv = document.getElementById('result');
                    var paragraph = document.createElement('p');
                    paragraph.textContent = text;
                    resultDiv.appendChild(paragraph);

                    // Increment the counter
                    count++;

                    // Stop after extracting the first 20 items
                    if (count >= 20) {
                        break;
                    }
                }
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        };

        // Handle errors
        xhr.onerror = function () {
            console.error('Request failed');
        };

        // Send the request
        xhr.send();
</script>
<div id="result"></div>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>

<?php

    

    

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