<main id="checkout-page" class="flex flex-col-reverse w-full md:flex-row overflow-x-hidden">
    <section class="checkout-form-wrapper flex flex-col flex-grow p-4 pb-16 hidden-scroll">
        <div class="flex flex-col mb-4">
            <h1 class="logo text-3xl font-bold">
                <img src="<?=\JPeraTheme\AssetResolver::resolve('img/Logo-Horizontal.svg')?>" alt="JPera">
            </h1>
            <div class="flex flex-row">
                <a href="<?= home_url() ?>" class="text-red">Back to Shop</a>
                <div id="mobile-checkout-info" class="ml-6 underline cursor-pointer hidden">Checkout info</div>
            </div>
        </div>

        <?php
        // Display Checkout form
        $checkout = WC_Checkout::instance();
        wc_get_template('checkout/form-checkout.php', array( 'checkout' => $checkout ));
        ?>
    </section>

    <section id="review" class="sidebar flex flex-col md:w-1/3 bg-blue-light text-white pb-16 hidden-scroll">
        <h2 class="text-5xl text-center py-6">Order Review</h2>

        <?php woocommerce_mini_cart(); ?>

        <div class="coupon-wrapper">
            <?php do_action( 'sidebar-checkout-coupon' ); ?>
        </div>

        <?php
         wc_get_template('checkout/review-order.php', array( 'checkout' => $checkout ));
        ?>

        <div class="order-total-amount flex flex-col text-center">
            <h3 class="text-2xl">Total</h3>
            <span class="order-grand-total-price text-5xl font-whyte"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>
    </section>

    <section class="logo-mobile flex flex-col flex-grow p-4 md:hidden">
        <div class="flex flex-col">
            <h1 class="logo text-3xl font-bold">
                <img src="<?=\JPeraTheme\AssetResolver::resolve('img/Logo-Horizontal.svg')?>" alt="JPera">
            </h1>
        </div>
    </section>


    <style>
        /* #checkout-page */
        /*  /assets/scss/components/_checkout-page.scss
        /*}*/

        body.mobile:not(.iPad) #checkout-page .sidebar,
        body.mobile:not(.iPad) #checkout-page .checkout-form-wrapper {
            overflow: visible;
        }
    </style>


    <script>
        // page needs to be reloaded on cart update to rebuild proper checkout form
        jQuery(document.body).on('added_to_cart', function (e) {
            jQuery(document.body).trigger("update_checkout");
        })
        jQuery('#billing_postcode, #shipping_postcode').on('change', function (e) {
            jQuery(document.body).trigger("update_checkout");
        })
    </script>
    <script>
        document.getElementById("mobile-checkout-info").addEventListener("click", showMinicart);
        document.getElementById("review").addEventListener("click", showMinicart);

        function showMinicart(){
            document.getElementById("review").classList.toggle("mobileShow");        }
    </script>
</main>