<?php get_header(); ?>

<?php get_template_part( 'templates/partials/header-myshop' ); ?>
<div class="flex flex-row">
    <div class="flex flex-col">
        <div id="profileHeader" class="flex flex-row">
            <div id="profilePic" class="flex flex-col">
                <?php the_title(); ?>
                <?php the_post_thumbnail('medium'); ?>
                <span id="mood" class="inline-block"><b>Mood:</b> <?php get_field('header_mood') ? the_field('header_mood') : null ;?></span>

            </div>
            <div id="profileInfo" class="flex flex-col">
                <?php the_field('header_blurb'); ?>
                <?php the_field('header_stats'); ?>
                <div>
                    <p>Last Login:</p>
                    <p><?php echo date("m/d/"); ?>2006</p>
                </div>
            </div>
        </div>

        <div id="contactBox" class="flex flex-row">
            <ul class="flex flex-col">
                <li><a href=""><img src="" />Send Message</a></li>
                <li><a href=""><img src="" />Add to Friends</a></li>
                <li><a href=""><img src="" />Instant Message</a></li>
                <li><a href=""><img src="" />Add to Group</a></li>
            </ul>
            <ul class="flex flex-col">
                <li><a href=""><img src="" />Forward to Friend</a></li>
                <li><a href=""><img src="" />Add to Favorites</a></li>
                <li><a href=""><img src="" />Block User</a></li>
                <li><a href=""><img src="" />Rank User</a></li>
            </ul>
        </div>

        <?php if( have_rows('interests') ): ?>
            <div id="interestsBox" class="blueBox flex flex-col">
                <div class='titleBox'><?php the_title(); ?>'s Interests</div>

                <?php if( get_field('interests_general') ): ?>
                    <div class="flex flex-row">
                        <div>General</div>
                        <div><?php the_field('interests_general'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('interests_music') ): ?>
                    <div class="flex flex-row">
                        <div>Music</div>
                        <div><?php the_field('interests_music'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('interests_movies') ): ?>
                    <div class="flex flex-row">
                        <div>Movies</div>
                        <div><?php the_field('interests_movies'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('interests_tv') ): ?>
                    <div class="flex flex-row">
                        <div>Television</div>
                        <div><?php the_field('interests_tv'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('interests_books') ): ?>
                    <div class="flex flex-row">
                        <div>Books</div>
                        <div><?php the_field('interests_books'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('interests_heroes') ): ?>
                    <div class="flex flex-row">
                        <div>Heroes</div>
                        <div><?php the_field('interests_heroes'); ?></div>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if( have_rows('details') ): ?>
            <div id="detailsBox" class="blueBox flex flex-col">
                <div class='titleBox'><?php the_title(); ?>'s Details</div>

                <?php if( get_field('details_status') ): ?>
                    <div class="flex flex-row">
                        <div>Status:</div>
                        <div><?php the_field('details_status'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_hometown') ): ?>
                    <div class="flex flex-row">
                        <div>Here for:</div>
                        <div><?php the_field('details_here'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_hometown') ): ?>
                    <div class="flex flex-row">
                        <div>Hometown:</div>
                        <div><?php the_field('details_hometown'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_ethnicity') ): ?>
                    <div class="flex flex-row">
                        <div>Ethnicity:</div>
                        <div><?php the_field('details_ethnicity'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_zodiac') ): ?>
                    <div class="flex flex-row">
                        <div>Zodiac:</div>
                        <div><?php the_field('details_zodiac'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_smokedrink') ): ?>
                    <div class="flex flex-row">
                        <div>Smoke / Drink:</div>
                        <div><?php the_field('details_smokedrink'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_education') ): ?>
                    <div class="flex flex-row">
                        <div>Education:</div>
                        <div><?php the_field('details_education'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( get_field('details_occupation') ): ?>
                    <div class="flex flex-row">
                        <div>Occupation:</div>
                        <div><?php the_field('details_occupation'); ?></div>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

    </div>

    <div class="flex flex-col">

        <?php the_field('blurb'); ?>

        <?php
            
            the_field('blurb');
            
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

            the_content();

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
    </div>

</div>


<?php get_footer(); ?>