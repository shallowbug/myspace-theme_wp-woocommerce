<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

        <div class="billing-details-header flex ">
            <h3 class="flex-grow"><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox self-center">
				<input id="ship-to-different-address-checkbox-top" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="ship_to_different_address" value="1"> <span>Ship to a different address?</span>
                <script>
                    let shipToDifferentAddressCheckboxTop = document.getElementById('ship-to-different-address-checkbox-top')
                    shipToDifferentAddressCheckboxTop.addEventListener('click', () => {
                        let shipToDifferentAddressCheckbox = document.getElementById('ship-to-different-address-checkbox')
                        shipToDifferentAddressCheckbox.click()
                    })
                </script>
			</label>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper flex flex-col">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );
        ?>

        <div class="billing-names flex flex-row space-x-2">
            <?php
                $keys = [
                    'billing_first_name',
                    'billing_last_name'
                ];

                foreach ($keys as $key) {
                    woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
                    unset($fields[$key]);
                }
            ?>
        </div>

        <div class="billing-address flex flex-col">
            <?php
                $keys = [
                    'billing_company',
                    'billing_address_1',
                    'billing_address_2',
                    'billing_city',
                ];

                foreach ($keys as $key) {
                    woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
                    unset($fields[$key]);
                }
            ?>

            <div class="billing-address-region flex flex-row justify-items-stretch space-x-2">
                <?php
                    $keys = [
                        'billing_country',
                        'billing_state',
                        'billing_postcode',
                    ];

                    foreach ($keys as $key) {
                        woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
                        unset($fields[$key]);
                    }
                ?>
            </div>
        </div>

		<?php
        // Everything else...
		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
