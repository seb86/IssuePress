<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IssuePress
 * @subpackage IssuePress/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    IssuePress
 * @subpackage IssuePress/admin
 * @author     Your Name <email@example.com>
 */
class IssuePress_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $name    The ID of this plugin.
	 */
	private $name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Instance of IssuePress class
	 *
	 * @since 1.0.0
	 * @access private
	 * @var		object			$plugin			This is the instance of the IssuePress class.
	 */
	private $plugin;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version, $instance ) {

		$this->name = $name;
		$this->version = $version;
		$this->plugin = $instance;

	}


	/**
	 * Register the Custom Post Types
	 *
	 * @since		1.0.0
	 */
	public function register_post_types() {

		// Create Support Request Custom Post Type
		$support_request_labels = apply_filters( 'ip_support_request_labels', array(
			'name'                => _x( 'Support Requests', 'Post Type General Name', $this->name ),
			'singular_name'       => _x( 'Support Request', 'Post Type Singular Name', $this->name ),
			'menu_name'           => __( 'Support', $this->name ),
			'parent_item_colon'   => __( 'Parent Request:', $this->name ),
			'all_items'           => __( 'All Support Requests', $this->name ),
			'view_item'           => __( 'View Request', $this->name ),
			'add_new_item'        => __( 'Add New Request', $this->name ),
			'add_new'             => __( 'Add New', $this->name ),
			'edit_item'           => __( 'Edit Request', $this->name ),
			'update_item'         => __( 'Update Request', $this->name ),
			'search_items'        => __( 'Search Request', $this->name ),
			'not_found'           => __( 'Not found', $this->name ),
			'not_found_in_trash'  => __( 'Not found in Trash', $this->name ),
		) );

		$rewrites = apply_filters( 'ip_support_request_rewrite_args', array(
			'slug'                => apply_filters( 'ip_base_rewrite_slug', 'support-requests' ),
			'with_front'          => false,
		) );

		$support_request_args = array(
			'label'               => __( 'ip_support_request', $this->name ),
			'description'         => __( 'Customer support requests.', $this->name ),
			'labels'              => $support_request_labels,
			'public'              => true,
			'has_archive'         => false,
			'menu_icon'           => 'dashicons-sos',
			'supports'            => array( 'title', 'editor', 'comments', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 24,
			'can_export'          => true,
			'has_archive'         => true,
			'rewrite'             => $rewrites,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page'
		);

		register_post_type( 'ip_support_request', apply_filters( 'ip_support_request_post_type_args', $support_request_args ) );


	}

	/**
	 * Register the Custom Taxonomies
	 *
	 * @since		1.0.0
	 */
	public function register_taxonomies() {


		// Create Support Request Sections Custom Taxonomy
		$support_section_labels = apply_filters( 'ip_support_section_labels', array(
			'name'                       => _x( 'Sections', 'Taxonomy General Name', $this->name ),
			'singular_name'              => _x( 'Section', 'Taxonomy Singular Name', $this->name ),
			'menu_name'                  => __( 'Sections', $this->name ),
			'all_items'                  => __( 'All Sections', $this->name ),
			'parent_item'                => __( 'Parent Section', $this->name ),
			'parent_item_colon'          => __( 'Parent Section:', $this->name ),
			'new_item_name'              => __( 'New Section Name', $this->name ),
			'add_new_item'               => __( 'Add New Section', $this->name ),
			'edit_item'                  => __( 'Edit Section', $this->name ),
			'update_item'                => __( 'Update Section', $this->name ),
			'separate_items_with_commas' => __( 'Separate sections with commas', $this->name ),
			'search_items'               => __( 'Search Sections', $this->name ),
			'add_or_remove_items'        => __( 'Add or remove sections', $this->name ),
			'choose_from_most_used'      => __( 'Choose from the most used sections', $this->name ),
			'not_found'                  => __( 'Not Found', $this->name ),
		) );

		$support_section_rewrites = apply_filters( 'ip_support_section_rewrites', array(
			'slug'				=> apply_filters( 'ip_secion_rewrite_slug', 'support-sections' ),
			'with_front'	=> false
		) );

		$support_section_args = apply_filters( 'ip_support_section_args', array(
			'labels' 							=> $support_section_labels,
			'show_admin_column'		=> true,
			'hierarchical'				=> true,
			'rewrite'							=> $support_section_rewrites
		));

		register_taxonomy( 'ip_support_section', 'ip_support_request', $support_section_args );


		// Create Support Request Labels Custom Taxonomy
		$support_label_labels = apply_filters( 'ip_support_label_labels', array(
			'name'                       => _x( 'Labels', 'Taxonomy General Name', $this->name ),
			'singular_name'              => _x( 'Label', 'Taxonomy Singular Name', $this->name ),
			'menu_name'                  => __( 'Labels', $this->name ),
			'all_items'                  => __( 'All Labels', $this->name ),
			'parent_item'                => __( 'Parent Label', $this->name ),
			'parent_item_colon'          => __( 'Parent Label:', $this->name ),
			'new_item_name'              => __( 'New Label Name', $this->name ),
			'add_new_item'               => __( 'Add New Label', $this->name ),
			'edit_item'                  => __( 'Edit Label', $this->name ),
			'update_item'                => __( 'Update Label', $this->name ),
			'separate_items_with_commas' => __( 'Separate labels with commas', $this->name ),
			'search_items'               => __( 'Search Labels', $this->name ),
			'add_or_remove_items'        => __( 'Add or remove labels', $this->name ),
			'choose_from_most_used'      => __( 'Choose from the most used labels', $this->name ),
			'not_found'                  => __( 'Not Found', $this->name ),
		) );

		$support_label_args = apply_filters( 'ip_support_label_args', array(
			'labels' 							=> $support_label_labels,
			'show_admin_column'		=> true,
		));

		register_taxonomy( 'ip_support_label', 'ip_support_request', $support_label_args );

	}


	/**
	 * IP Parse Query method, checks for IP during parse_query action.
	 *
	 * @since			1.0.0
	 */
	public function parse_query( $query ) {

		// Bail if $posts_query is not the main loop
		if ( ! $query->is_main_query() )
			return;

		// Bail if filters are suppressed on this query
		if ( true === $query->get( 'suppress_filters' ) )
			return;

		// Bail if in admin
		if ( is_admin() )
			return;

		do_action( 'ip_parse_query', $query );

	}	

	/** 
	 * IP Template Include Method called on WP template_include filter
	 *
	 * @since			1.0.0
	 */
	public function template_include( $template ) {

		return apply_filters( 'ip_template_include', $template );

	}

	/**
	 * IP Widgets Init, hooks into widgets_init
	 *
	 * Use to initialize ip widgets
	 *
	 * @since			1.0.0
	 */
	public function ip_widgets_init() {
		do_action( 'ip_widgets_init' );
	}



	/**
	 * Register shortcodes for IssuePress
	 *
	 * @since			1.0.0
	 */
	public function register_shortcodes() {

		add_shortcode( 'ip_support_form', 		array($this, "shortcode_support_form") );
		add_shortcode( 'ip_support_sections', array($this, "shortcode_support_sections") );
		add_shortcode( 'ip_support_search_form', array($this, "shortcode_support_search_form") );

	}


	/**
	 * Create Support Request Form shortcode method
	 *
	 * @since			1.0.0
	 */
	public function shortcode_support_form() {

		$template_loader = $this->plugin->get_template_loader();
		return $template_loader->get_clean_template_part( 'support', 'form' );

	}

	/**
	 * Create Support Request Sections shortcode method
	 *
	 * @since			1.0.0
	 */
	public function shortcode_support_sections() {

		$template_loader = $this->plugin->get_template_loader();
		return $template_loader->get_clean_template_part( 'support', 'sections' );

	}

	/**
	 * Create Support Request Search Form shortcode method
	 *
	 * @since			1.0.0
	 */
	public function shortcode_support_search_form() {

		return ip_get_search_form( false );

	}


	/**
	 * Render Template Notices
	 *
	 * Will check for any IP Errors and render them for templates.
	 *
	 * @since			1.0.0
	 */
	public function render_template_notices() {

		if( !ip_has_errors() )
			return;

		// Local variabel to hold errors array
		$errors = array();

		$ip_errors = $this->plugin->get_errors();

		foreach ( $ip_errors->get_error_codes() as $error_code ) {

			$error_data = $ip_errors->get_error_data( $error_code );
			$error_class = $error_data ? $error_data : '';

			foreach ( $ip_errors->get_error_messages( $error_code ) as $error ) {

				$errors[] = array( "class" => $error_class,  "message" => $error );

			}

		}


		if ( !empty($errors) )  {

			foreach ( $errors as $error ) : ?>

				<div class="ip-template-notice <?php echo $error['class']; ?>">
					<p><?php echo $error['message']; ?></p>
				</div>

			<?php endforeach;
		
		}

	}


	/**
	 * Filter the_content for IssuePress Support Requests
	 *
	 * @since			1.0.0
	 */
	public function filter_the_content( $content ) {
		global $post;

		$ip_meta = '';
		if ( $post->post_type == get_ip_support_request_post_type() ) {
			$template_loader = $this->plugin->get_template_loader();
			$template_loader->get_template_part( 'support', 'meta' );
		}

		return $content;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since			1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in IssuePress_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IssuePress_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->name, plugin_dir_url( __FILE__ ) . 'css/issuepress-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in IssuePress_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IssuePress_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/issuepress-public.js', array( 'jquery' ), $this->version, FALSE );

	}

}
