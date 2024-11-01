<?php

namespace ArticleGen\CBPlugin\Admin;

/**
 * Admin Menu class.
 *
 * Responsible for managing admin menus.
 */
class Menu {

    /**
     * Constructor.
     *
     * @since 0.2.0
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'init_menu' ] );
    }

    /**
     * Init Menu.
     *
     * @since 0.2.0
     *
     * @return void
     */
    public function init_menu() {
        global $submenu;

        $slug          = ARTICLE_GEN_SLUG;
        $menu_position = 50;
        $capability    = 'manage_options';
        $logo_icon     = ARTICLE_GEN_ASSETS . '/images/article-gen-logo-icon.png';

        add_menu_page( esc_attr__( 'Article Generator', 'article-gen' ), esc_attr__( 'Article Generator', 'article-gen' ), $capability, $slug, [ $this, 'plugin_page' ], $logo_icon, $menu_position );

        if ( current_user_can( $capability ) ) {
            $submenu[ $slug ][] = [ esc_attr__( 'Home', 'article-gen' ), $capability, 'admin.php?page=' . $slug . '#/' ]; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $submenu[ $slug ][] = [ esc_attr__( 'Contexts', 'article-gen' ), $capability, 'admin.php?page=' . $slug . '#/contexts' ]; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $submenu[ $slug ][] = [ esc_attr__( 'Settings', 'article-gen' ), $capability, 'admin.php?page=' . $slug . '#/settings' ]; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        }
    }

    /**
     * Render the plugin page.
     *
     * @since 0.2.0
     *
     * @return void
     */
    public function plugin_page() {
        require_once ARTICLE_GEN_TEMPLATE_PATH . '/app.php';
    }
}
