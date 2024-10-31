<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/admin
 * @author     Todd Halfpenny <todd@toddhalfpenny.com>
 */
class Past_Events_Extension_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name       The name of this plugin.
     * @param string $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action(
            'manage_session_posts_custom_column',
            array( $this, 'pee_session_table_content' ),
            10,
            2
        );
        add_action( 'add_meta_boxes', array( $this, 'pee_add_custom_meta' ) );
    }
    
    /**
     * Adds 'past-session' post_status to 'session' CPT
     *
     * @since 0.0.1
     */
    public function pee_past_session_post_status()
    {
        register_post_status( 'past-session', array(
            'label'                     => _x( 'Past Session', 'session' ),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'Past Session <span class="count">(%s)</span>', 'Past Session <span class="count">(%s)</span>' ),
        ) );
    }
    
    /**
     * Adds 'past-session' to Status dropdown box when editing a session
     *
     * @since 0.0.1
     */
    public function pee_append_post_status_list()
    {
        // Having to get post ID from the queryparmas, as the $post is showing the last speaker, instead of the session.
        $my_post_id = sanitize_text_field( $_GET['post'] );
        $my_post_type = get_post_type( $my_post_id );
        $complete = '';
        $label = '';
        
        if ( 'session' == $my_post_type ) {
            $my_post_status = get_post_status( $my_post_id );
            
            if ( 'past-session' == $my_post_status ) {
                $complete = ' selected=\\"selected\\"';
                $label = '<span id=\\"post-status-display\\"> Past Session</span>';
            }
            
            echo  '
			<script>
			jQuery(document).ready(function($){
					 $("select#post_status").append("<option value=\\"past-session\\" ' . esc_attr( $complete ) . '>Past Session</option>");
					 $(".misc-pub-section label").append("' . $label . '");
			});
			</script>
			' ;
        }
    
    }
    
    /**
     * Adds 'Status' Column to session listing admin page
     *
     * @since 0.0.1
     * @param array $columns  An array of column name ⇒ label.
     */
    public function pee_session_table_head( $columns )
    {
        return array_merge( $columns, array(
            'status' => __( 'Status', 'past-events-extension' ),
            'author' => __( 'Added by', 'past-events-extension' ),
        ) );
    }
    
    /**
     * Populates Status column in session listing admin page
     *
     * @since 0.0.1
     * @param string $column_name	The name of the column to display.
     * @param int    $post_id	The ID of the current post.
     */
    public function pee_session_table_content( $column_name, $post_id )
    {
        if ( 'status' == $column_name ) {
            switch ( get_post_status( $post_id ) ) {
                case 'private':
                    esc_attr_e( 'Private', 'past-events-extension' );
                    break;
                case 'draft':
                    esc_attr_e( 'Draft', 'past-events-extension' );
                    break;
                case 'past-session':
                    esc_attr_e( 'Past Session', 'past-events-extension' );
                    break;
                default:
                    esc_attr_e( get_post_status( $post_id ), 'past-events-extension' );
            }
        }
    }
    
    /**
     * Add custom metaboxes to the session CPT edit page
     *
     * @since 0.0.1
     */
    function pee_add_custom_meta()
    {
        if ( 'past-session' == get_post_status() ) {
            if ( pee_fs()->is_not_paying() ) {
                add_meta_box(
                    'pee-session-upgrade-meta-box',
                    __( 'Past Events Extension', 'past-events-extension' ),
                    array( $this, 'pee_session_upgrade_meta_box_markup' ),
                    'session',
                    'side',
                    'high',
                    null
                );
            }
        }
    }
    
    /**
     * Custom metabox markup for our PRO advert
     *
     * @since 0.0.1
     */
    function pee_session_upgrade_meta_box_markup()
    {
        echo  '<div class="inside"><h4>' . esc_html__( 'Session Assets', 'past-events-extension' ) . '</h4><p>' . esc_html__( 'Pro version supports audio/video embedding and slide deck links.', 'past-events-extension' ) ;
        echo  '<a class="button-primary" href="' . pee_fs()->get_upgrade_url() . '">' . esc_html__( 'Get PRO Features', 'widgets-on-pages' ) . '</a>' ;
        echo  '</div>' ;
    }
    
    /**
     * Register our setting
     *
     * @since    1.0.0
     */
    function pee_register_settings()
    {
        register_setting( 'pee_options', 'pee_options_field' );
    }
    
    /**
     * Add our settings page menu item
     *
     * @since  1.0.0
     */
    public function pee_add_options_page()
    {
        add_menu_page(
            __( 'Past Events Extension Settings', 'past-events-extension' ),
            __( 'Past Events', 'past-events-extension' ),
            'manage_options',
            $this->plugin_name,
            array( $this, 'pee_display_options_page' ),
            'dashicons-backup'
        );
    }
    
    /**
     * Render the options page for plugin
     *
     * @since  1.0.0
     */
    public function pee_display_options_page()
    {
        include_once 'partials/past-events-extension-admin-settings.php';
    }
    
    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/past-events-extension-admin.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
    }

}