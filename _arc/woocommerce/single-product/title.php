<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="product-series-logo-wrapper mb-4">
    <img class="mx-auto" src="<?php the_field('product_series_logo') ?>" alt="Product series logo">
    <style>
        .product-summary .product-series-logo-wrapper img {
            max-height: 3.75rem;
        }
    </style>
</div>

<div class="product-title mb-4">
    <?php
    the_title( '<h1 class="product_title entry-title text-4xl 2xl:text-6xl">( ', ' )</h1>' );
    ?>
</div>

