<?php

/**
 * Hook in and register a submenu options page for the Page post-type menu.
 */
function swi_register_options_submenu_for_options_general()
{

    /**
     * Registers options page menu item and form.
     */
    $cmb = new_cmb2_box(array(
        'id'           => 'swi_options',
        'title'        => esc_html__('Instagram Snapwidget', 'cmb2'),
        'object_types' => array('options-page'),

        /*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

        'option_key'      => 'swi_page_options', // The option key and admin menu page slug.
        // 'icon_url'        => '', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
        'parent_slug'     => 'options-general.php', // Make options page a submenu item of the themes menu.
        // 'capability'      => 'manage_options', // Cap required to view options-page.
        // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
        // 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
        // 'message_cb'      => 'swi_options_page_message_callback',
    ));

    $cmb->add_field(array(
        'name'       => esc_html__('Slug do Instagram', 'cmb2'),
        'desc'       => __('O <strong>slug</strong> é a parte final da url do instagram, após a última <code>/</code>. por exemplo, na url <code>https://www.instagram.com/loremipsum</code>, o slug seria o <code>loremipsum</code>.', 'cmb2'),
        'id'         => 'swi_slug',
        'type'       => 'text',
        'required'   => true
    ));

    $cmb->add_field(array(
        'name'       => esc_html__('ID do widget no Snapwidget', 'cmb2'),
        'desc'       => __('Para encontrar o <strong>ID</strong> do widget, acesse com a sua conta o <a href="https://snapwidget.com/" target="_blank">Snapwidget</a> e clique no widget que será usádo, como se fosse editá-lo. Na tela de edição do widget, observe que a url será algo assim <code>https://snapwidget.com/widgets/123456/edit</code>. O ID é o <strong>número</strong> dentro desta url (neste exemplo, seria <code>123456</code>).', 'cmb2'),
        'id'         => 'swi_id',
        'type'       => 'text',
        'required'   => true,
        'attributes' => array(
            'type' => 'number'
        ),
        'after_row' => '<div class="cmb-row cmb-type-text cmb2-id-swi-id table-layout"><p>' . __('Utilize o <strong>shortcode</strong> <code>[sw_instagram]</code> para exibir o widget do Instagram.', 'isw') . '</p></div>'
    ));
}
add_action('cmb2_admin_init', 'swi_register_options_submenu_for_options_general');

function isw_get_option($key = '', $default = false)
{
    if (function_exists('cmb2_get_option')) {
        // Use cmb2_get_option as it passes through some key filters.
        return cmb2_get_option('swi_page_options', $key, $default);
    }

    // Fallback to get_option if CMB2 is not loaded yet.
    $opts = get_option('swi_page_options', $default);

    $val = $default;

    if ('all' == $key) {
        $val = $opts;
    } elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[$key]) {
        $val = $opts[$key];
    }

    return $val;
}
