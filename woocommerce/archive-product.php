<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;


get_header( 'shop' );

/**
 * Open Left Panel
 */
get_template_part('templates/partials/left-panel-open');

$shop_color = get_theme_mod('shop_color', '#FEE100');
$shop_color_2 = get_theme_mod('shop_color_2', '#485DFF');
\JPeraTheme\View::render('BgBlocks', [
    'blocks' => [
        ['color' => $shop_color, 'rounded_class' => 'rounded-3xl'],
        ['color' => $shop_color_2, 'rounded_class' => 'rounded-full']
    ]
]);
?>


<div class="h-full w-full flex flex-col text-center">
    <?php
    \JPeraTheme\View::render('ProductFilters');
    ?>
</div>


<?php
/**
 * Open Right Panel
 */
get_template_part('templates/partials/left-panel-close');
get_template_part('templates/partials/right-panel-open');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
\JPeraTheme\View::render('MiniCart');
?>

<style>
    @media only screen and (max-width: 768px) {
        .right-panel {
            max-height: 50%;
        }
    }
</style>

<div class="marquee-wrapper flex">
    <div class="marquee3k h-0 md:h-auto overflow-hidden mb-2 mr-24 xl:mr-40" data-speed="0.25">
        <span class="marquee-text uppercase text-xl 2xl:text-2xl pr-6">
        <?php echo get_option('marquee', 'this is a marquee test '); ?>
        </span>
    </div>
    <ul class="flex ml-auto text-2xl font-normal">
        <li class="mr-6">
            <a href="/">Shop</a>
        </li>
        <li class="mr-6">
            <a href="#" class="nav-info">Info</a>
        </li>
        <li class="mr-6">
            <a href="https://www.instagram.com/j.pera_/" target="_blank">Social</a>
        </li>
    </ul>
    <div class="cartLink w-10 md:w-10 ml-4">
        <div data-opens="#miniCart">
            <?php
            \JPeraTheme\View::render('ShoppingCartLink');
            ?>
        </div>
        <style>
            .cart-size { filter: invert(1) }
        </style>
    </div>
</div>

<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	// do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}


get_template_part('templates/partials/right-panel-close');


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
