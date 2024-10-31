<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/public
 * @author     Todd Halfpenny <todd@toddhalfpenny.com>
 */
class Past_Events_Extension_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name       The name of the plugin.
     * @param      string $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Adds 'past-session' post_status to 'session' CPT
     *
     * @since    0.0.1
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
     * Adds our rewrite rule, for past-sessions
     *
     * @since    1.0.0
     */
    public function pee_add_rewrite_rule()
    {
        add_rewrite_rule( '^past-sessions$', 'index.php?pee_past_sessions=true', 'top' );
    }
    
    /**
     * Adds an extra query_var, something to do with the above being lost.
     * Part of adding a re-write rule.
     *
     * @since    1.0.0
     * @param  array $query_vars The incoming query vars.
     * @return array             Our updated query vars.
     */
    public function pee_add_query_vars( $query_vars )
    {
        $query_vars[] = 'pee_past_sessions';
        return $query_vars;
    }
    
    /**
     * Parese the request, to see if it's for our past-sessions.
     *
     * @since    1.0.0
     * @param  array $wp Incoming query (passed by reference).
     */
    public function pee_parse_request( &$wp )
    {
        
        if ( array_key_exists( 'pee_past_sessions', $wp->query_vars ) ) {
            include dirname( __FILE__ ) . '/partials/past-sessions.php';
            exit;
        }
    
    }
    
    /**
     * Gets the markup for past-sessions, based upon incoming query param
     *
     * @since  1.0.0
     * @param  array   $meta   Metadata for the post.
     * @param  boolean $single Are we handling a single post, or part of a loop.
     * @return string
     */
    public static function get_past_sessions_markup( $meta, $single = false )
    {
        $date = $meta['session_date'][0];
        ob_start();
        ?>
				<div class="heading  past-session">
					<div class="container">
							<h1>
								<?php 
        
        if ( $single ) {
            the_title();
        } else {
            ?>
									<a href="<?php 
            echo  get_permalink() ;
            ?>"><?php 
            the_title();
            ?></a>
									<?php 
        }
        
        ?></h1>
					</div>
				</div>
				<div class="container">
					<div class="row">

						<div class="col-md-8">
							<?php 
        the_content();
        ?>
							<p><br /></p>
							<div class="loader-img">
									<img alt="Loading" src="<?php 
        echo  get_template_directory_uri() ;
        ?>/images/ajax-loader.gif" width="32" height="32" align="center" />
							</div>
							<?php 
        
        if ( $single ) {
            ?>
							<div id="past-session-assets">
								<?php 
            _e( '<h2>Session Assets</h2>', 'past-events-extension' );
            $pee_session_vid_link = get_post_meta( get_the_ID(), '_pee_session_vid_link', true );
            $pee_session_slides_link = get_post_meta( get_the_ID(), '_pee_session_slides_link', true );
            if ( $pee_session_vid_link ) {
                echo  wp_oembed_get( $pee_session_vid_link ) ;
            }
            if ( $pee_session_slides_link ) {
                echo  '<p><a href="' . $pee_session_slides_link . '">View the slides</a></p>' ;
            }
            if ( !$pee_session_vid_link && !$pee_session_slides_link ) {
                _e( '<p>There are no assets uploaded yet for this session</p>', 'past-events-extension' );
            }
            ?>
							</div>
						<?php 
        }
        
        ?>
						</div>
						<div class="col-md-4 sessions single">
							<div class="session past-session">
								<?php 
        $speakers_list = unserialize( $meta['session_speakers_list'][0] );
        ?>
								<span class="date"><?php 
        _e( 'Ran on:', 'past-events-extension' );
        ?> <strong><?php 
        echo  ( !empty($date) ? date_i18n( get_option( 'date_format' ), $date ) : '' ) ;
        ?></strong></span>
								<span class="speakers-thumbs">
										<?php 
        if ( !empty($speakers_list) ) {
            foreach ( $speakers_list as $speaker_id ) {
                ?>
													<a href = "<?php 
                echo  get_permalink( $speaker_id ) ;
                ?>" class="speaker<?php 
                if ( get_post_meta( $speaker_id, 'speaker_keynote', true ) == 1 ) {
                    echo  ' featured' ;
                }
                ?>">
															<?php 
                echo  get_the_post_thumbnail( $speaker_id, 'post-thumbnail', array(
                    'title' => get_the_title( $speaker_id ),
                ) ) ;
                ?>
															<span class="name"><span class="text-fit"><?php 
                echo  get_the_title( $speaker_id ) ;
                ?></span></span>
													</a>
													<?php 
            }
        }
        ?>
								</span>
							</div>
						</div>
					</div>
				</div>
		<?php 
        return ob_get_clean();
    }
    
    /**
     * Filter to hijack temlating for "sessions" with  "past-session" status
     *
     * @since 1.0.0
     * @param  string $template The path of the template being requested.
     * @return string           The template we are returning, perhaps our special one.
     */
    public function pee_past_session_template( $template )
    {
        return $template;
    }
    
    /**
     * Remove  Jetpack's related posts from appearing for past-sessions
     *
     * @since    1.0.1
     * @param  array $allowed_post_types Allowed post types.
     * @return arrray                    Updated allowed post types.
     */
    function pee_no_jetpack_related_posts( $allowed_post_types )
    {
        if ( is_singular( 'session' ) && 'past-session' == get_post_status() ) {
            $allowed_post_types['enabled'] = false;
        }
        return $allowed_post_types;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/past-events-extension-public.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
    }

}