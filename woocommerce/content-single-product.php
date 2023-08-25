<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 * 
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div class="product-wrapper relative overflow-hidden">
    <?php
    $blobColor = get_field('blob_bg_color') ? get_field('blob_bg_color') : '#2DE00D';
    $contentTextColor = 'text-' . get_field('content_text_color');
    \JPeraTheme\View::render('BgBlocks', [
        'blocks' => [
            ['color' => $blobColor, 'rounded_class' => 'rounded-3xl'],
        ]
    ]);
    ?>

    <style>
        @media only screen and (min-width: 769px) {
            .product-wrapper,
            .product-wrapper .product {
                max-height: 90vh;
            }
            body.iPad .product-wrapper, body.iPad .product-wrapper .product {
                max-height: 87vh;
            }

            main {
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            #primary {
                height: 100%;
            }
            .add-to-cart-wrapper {
                height: 10vh;
                flex-shrink: 0;
            }
        }
        @media only screen and (max-width: 768px) {
            .product-wrapper .product {
                padding-bottom: 20vh;
            }
            body:not(.iPad) .left-panel,
            body:not(.iPad) .right-panel {
                max-height: 50%;
            }
        }
    </style>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-box overflow-y-scroll -mr-4 py-12 max-h-full overflow-auto ' . $contentTextColor, $product ); ?>>
        <div id="desc-scroll" class="scroll-img">
            <img src="<?=\JPeraTheme\AssetResolver::resolve('img/scroll-icon.svg'); ?>">
        </div>

        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * X @hooked woocommerce_show_product_sale_flash - 10
         * X @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        ?>

        <div class="product-summary entry-summary text-center px-12">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * X @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * X @hooked woocommerce_template_single_excerpt - 20
             * X @hooked woocommerce_template_single_add_to_cart - 30
             * X @hooked woocommerce_template_single_meta - 40
             * X @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>

        <div class="product-details">
            <div class="product-description text-xl md:text-2xl mb-12 px-12">
                <?php echo nl2br($product->get_description()); ?>
            </div>

            <?php if (get_field('profile') ): ?>
                <div class="desc-spacer"></div>
                <div class="product-profile text-left my-6 px-12">
                    <h2 class="text-4xl mb-2 font-lothian-xs text-left">Scent Profile</h2>
                    <div class="text-xl md:text-2xl">
                        <?php the_field('profile'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (get_field('features') ): ?>
                <div class="desc-spacer"></div>
                <div class="product-features text-left my-6 px-12">
                    <h2 class="text-4xl mb-2 font-lothian-xs text-left">Features</h2>
                    <div class="text-xl md:text-2xl">
                        <?php the_field('features'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (get_field('ingredients') ): ?>
                <div class="desc-spacer"></div>
                <div class="product-ingredients text-left my-6 px-12">
                    <h2 class="text-4xl mb-2 font-lothian-xs text-left">Ingredients</h2>
                    <div class="text-xl">
                        <?php the_field('ingredients'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="desc-spacer"></div>
            <div class="info italic pt-8 cursor-pointer link w-full text-center px-12">
                <img class="exit w-6 h-8 cursor-pointer inline-block" src="<?=\JPeraTheme\AssetResolver::resolve('img/Info.png'); ?>">
                Shipping and Returns
            </div>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * X @hooked woocommerce_output_product_data_tabs - 10
         * X @hooked woocommerce_upsell_display - 15
         * X @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>
</div>
<div class="add-to-cart-wrapper font-g2-ciao-shrill text-4xl font-normal mb-12 md:mb-0 absolute md:relative bottom-0 w-full bg-white" style="height: 10vh">
    <?php do_action( 'woocommerce_after_single_product' ); ?>
</div>
<style>
    .add-to-cart{
        pointer-events: none;
    }
    .add-to-cart-wrapper .quantity {display: none}
    .add-to-cart-wrapper form {height: 100%;}
    .add-to-cart-wrapper button {
        width: 100%;
        height: 100%;
        background: transparent !important;
        color: black !important;
        border: 2px solid black !important;
        border-radius: 3rem !important;
    }
    .add-to-cart-wrapper button:hover {
        background: <?= $blobColor ?> !important;
        color: <?= $contentTextColor ?> !important;
    }

    .product-description, .product-profile, .product-features, .product-ingredients {
        line-height: 1.15;
        letter-spacing: -0.26px;
    }
    .single-product #wcpay-payment-request-wrapper,
    .single-product #wcpay-payment-request-button-separator,
    .single-product .stock.in-stock,
    .single-product #wc-stripe-payment-request-button-separator,
    .single-product #wc-stripe-payment-request-wrapper{
        display: none !important;
    }
    .single-product .stock.out-of-stock{
        text-align: center;
    }
    .desc-spacer{
        height: 3px;
        width: 100%;
        border-bottom: 2px solid #000;
    }
    .product-features ul li{
        text-align: left !important;
        list-style: disc;
    }
</style>
