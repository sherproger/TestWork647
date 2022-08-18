<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */




/**
///////////////////////////////////для вкладки Запасы//////////////////////////////////
add_action('woocommerce_product_options_general_product_data', 'shop_add_custom_fields');
function shop_add_custom_fields() {
    echo '<div class="options_group">';// Группировка полей
    woocommerce_wp_text_input( array(
        'id'                => '_product_barcode',
        'label'             => __( 'Штрихкод-kod', 'woocommerce' ),
        'placeholder'       => 'Введите штрихкод товара',
        'desc_tip'          => 'true',
        'custom_attributes' => array(),
        'description'       => __( 'Введите штрихкод товара', 'woocommerce' ),
    ) );
    echo '</div>';
}


add_action( 'woocommerce_process_product_meta', 'save_barcode', 10, 1 );
function save_barcode( $post_id ){
    $text_field = isset( $_POST['_product_barcode'] ) ? sanitize_text_field( $_POST['_product_barcode'] ) : '';
    update_post_meta($post_id,'_product_barcode', $text_field );

}


add_action( 'woocommerce_before_add_to_cart_form', 'art_get_text_field_before_add_card' );
function art_get_text_field_before_add_card() {
    global $post;
    ?>
    <div class="text-field">
        Штрихкод: <?php echo get_post_meta( $post->ID, '_product_barcode', true ); ?>
    </div>
    <?php
}

/////////////////////////////////////////////////////////////////////
**/



//////////////////////////////////////////////////////////////////////////////////////////////
add_action('woocommerce_product_options_general_product_data', 'shop_add_custom_fields');
function shop_add_custom_fields() {
    echo '<div class="options_group">';// Группировка полей
    woocommerce_wp_text_input( array(
        'id'                => '_product_barcode',
        'label'             => __( 'Тестовое-поле-kod', 'woocommerce' ),
        'placeholder'       => '',
        'desc_tip'          => 'true',
        'custom_attributes' => array(),
        'description'       => __( 'Введите текст', 'woocommerce' ),
    ) );
    echo '</div>';
}


add_action( 'woocommerce_process_product_meta', 'save_barcode', 10, 1 );
function save_barcode( $post_id ){
    $text_field = isset( $_POST['_product_barcode'] ) ? sanitize_text_field( $_POST['_product_barcode'] ) : '';
    update_post_meta($post_id,'_product_barcode', $text_field );

}


add_action( 'woocommerce_before_add_to_cart_form', 'art_get_text_field_before_add_card' );
function art_get_text_field_before_add_card() {
    global $post;
    ?>
    <div class="text-field">
        <b>Тест поле:</b> <em><u><?php echo get_post_meta( $post->ID, '_product_barcode', true ); ?></u></em>
    </div>
    <?php
}

//////////////////////////////////////////////////////////////////////////////////////////////
// Включение и отображение полей в backend
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
function woo_add_custom_general_fields() {

    echo '<div class="options_group">';

    woocommerce_wp_select( array( // Тип текстового поля
        'id'          => '_Stan',
        'label'       => __( 'Тип продукта-kod', 'woocommerce' ),
        'description' => __( 'Не тыкай сюда! Выбери тип продукта.', 'woocommerce' ),
        'desc_tip'    => true,
        'options'     => array(
            ''        => __( 'Выберите тип продукта', 'woocommerce' ),
            'rare'    => __('rare', 'woocommerce' ),
            'frequent' => __('frequent', 'woocommerce' ),
            'unusual' => __('unusual', 'woocommerce' ),
        )
    ) );

    echo '</div>';
}

// Сохранение значений полей в базе данных при отправке (Backend)
add_action( 'woocommerce_process_product_meta', 'woo_save_custom_general_fields', 30, 1 );
function woo_save_custom_general_fields( $post_id ){

    // Сохранение ключа/значения в поля "Условия"
    $posted_field_value = $_POST['_Stan'];
    if( ! empty( $posted_field_value ) )
        update_post_meta( $post_id, '_Stan', esc_attr( $posted_field_value ) );


}

// Отображение во front-end части
add_action( 'woocommerce_product_meta_start', 'woo_display_custom_general_fields_values', 50 );
function woo_display_custom_general_fields_values() {
    global $product;

    // совместимость с WC +3
    $product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;

    echo '<span class="stan" style="background-color:grey;color:white;padding:5px;">Тип товара: ' . get_post_meta( $product_id, '_Stan', true ) . '</span>';
}

//////////////////////////////////////////////////////////////////////////////////////////////
// Включение и отображение полей в backend
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_field2s' );
function woo_add_custom_general_field2s() {

    echo '<div class="options_group">';

    woocommerce_wp_text_input( array( // Тип текстового поля
        'id'          => '_when_was_created',
        'label'       => __( 'Добавить дату-kod', 'woocommerce' ),
        'placeholder'       => '',
        'type'          => 'date',
        'desc_tip'          => 'true',
        'custom_attributes' => array(),
        'description'       => __( 'Добавить дату', 'woocommerce' ),
    ) );

    echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'date_created', 10, 1 );
function date_created( $post_id ){
    $text_field = isset( $_POST['_when_was_created'] ) ? $_POST['_when_was_created'] : '';
    update_post_meta($post_id,'_when_was_created', $text_field );

}

add_action( 'woocommerce_before_add_to_cart_form', 'art_get_text_field_before_add_card2' );
function art_get_text_field_before_add_card2() {
    global $post;
    ?>
    <div class="text-field">
        <b>Товар был создан:</b> <em><u><?php echo get_post_meta( $post->ID, '_when_was_created', true ); ?></u></em>
    </div>
    <?php
}
///////////////////////////////////////////////////////////////////////////////////////////////