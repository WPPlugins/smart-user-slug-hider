<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !class_exists( 'Smart_User_Slug_Hider' ) ) { 

  class Smart_User_Slug_Hider {
    
    public $plugin_name;
    public $plugin_slug;
    public $version;
    private $wp_url;
    private $my_url;
    private $dc_url;
    private $_file;
    
    public function __construct( $file ) {
      $this->_file = $file;
      $this->plugin_name = 'smart User Slug Hider';
      $this->plugin_slug = 'smart-user-slug-hider';
      $this->version = '1.2';
      $this->init();
    }
    
    function init() {
      add_action( 'pre_get_posts', array( $this, 'alter_query' ), 99 );
      add_filter( 'author_link', array( $this, 'alter_link' ), 99, 3 );
      if ( is_admin() ) {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'add_info_page' ) );
        add_filter( 'plugin_action_links_' . plugin_basename( $this->_file ), array( $this, 'add_link' ) ); 
      }
      add_shortcode( 'smart_user_slug', array( $this, 'shortcode_smart_user_slug' ) );
      add_shortcode( 'smart_user_url', array( $this, 'shortcode_smart_user_url' ) );
      add_shortcode( 'smart_user_link', array( $this, 'shortcode_smart_user_link' ) );
    }
    
    function admin_init() {
      $this->wp_url = 'https://wordpress.org/plugins/' . $this->plugin_slug;
      $this->my_url = 'http://petersplugins.com/free-wordpress-plugins/' . $this->plugin_slug;
      $this->dc_url = 'http://petersplugins.com/docs/' . $this->plugin_slug;
      load_plugin_textdomain( 'smart-user-slug-hider' );
    }

    private function encrypt( $id ) {
      return bin2hex( mcrypt_encrypt( MCRYPT_BLOWFISH, md5( $_SERVER['SERVER_ADDR'] . $this->_file ), base_convert( $id, 10, 36 ), 'ecb' ) );
    }

    private function decrypt( $encid ) {
      return base_convert( mcrypt_decrypt( MCRYPT_BLOWFISH, md5( $_SERVER['SERVER_ADDR'] . $this->_file ), pack('H*', $encid), 'ecb' ), 36, 10 );
    }

    function alter_query( $query ) {
      if ( $query->is_author() && $query->query_vars['author_name'] != '' ) {
        if ( ctype_xdigit( $query->query_vars['author_name'] ) ) {
          $user = get_user_by( 'id', $this->decrypt( $query->query_vars['author_name'] ) );
          if ( $user ) {
            $query->set( 'author_name', $user->user_nicename );
          } else {
            $query->is_404 = true;
            $query->is_author = false;
            $query->is_archive = false;
          }
        } else {
          $query->is_404 = true;
          $query->is_author = false;
          $query->is_archive = false;
        }
      }
      return;
    }

    function alter_link( $link, $author_id, $author_nicename ) {
      return str_replace ( '/' . $author_nicename, '/' . $this->encrypt( $author_id ), $link );
    }
    
     function add_link( $links ) {
      return array_merge( $links, array( '<a class="dashicons dashicons-editor-help" href="' . menu_page_url( $this->plugin_slug, false ) . '"></a>', '<a href="https://wordpress.org/plugins/' . $this->plugin_slug . '/">' . __( 'Please rate Plugin', 'smart-user-slug-hider' ) .'</a>' ) );
    }
    
    function add_info_page() {
      add_submenu_page( null, $this->plugin_name, $this->plugin_name, 'read', $this->plugin_slug, array( $this, 'show_info_page' ) );
    }
    
    function show_info_page() {
      ?>    
      <div class="wrap">
        <?php screen_icon(); ?>
        <h2 style="min-height: 32px; line-height: 32px; padding-left: 40px; background-image: url(<?php echo plugins_url( 'pluginicon.png', $this->_file ); ?>); background-repeat: no-repeat; background-position: left center"><a href="<?php echo $this->my_url; ?>"><?php echo $this->plugin_name; ?></a></h2>
        <hr />
        <p>Plugin Version: <?php echo $this->version; ?> <a class="dashicons dashicons-editor-help" href="<?php echo $this->wp_url; ?>/changelog/"></a></p>
        <div id="poststuff">
          <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
              <div class="meta-box-sortables ui-sortable">
                <div class="postbox">
                  <div class="inside">
                    <p><strong><?php _e( 'This Plugin replaces user names with 16 digits coded strings.', 'smart-user-slug-hider' ); ?></strong></p>
                    <p><?php _e( 'There are no settings.', 'smart-user-slug-hider' ); ?></p>
                  </div>
                </div>
                <div class="postbox">
                  <div class="inside">
                    <p><strong><?php _e( 'Do you like the smart User Slug Hider Plugin?', 'smart-user-slug-hider' ); ?></strong></p>
                    <p><a href="https://profiles.wordpress.org/petersplugins/#content-plugins"><?php _e( 'Please take a look at my other plugins.', 'smart-user-slug-hider' ); ?></a></p>
                  </div>
                </div>
              </div>
            </div>
            <?php { $this->show_meta_boxes(); } ?>
          </div>
          <br class="clear">
        </div>    
      </div>
      <?php
    }
    
    // show meta boxes
    function show_meta_boxes() {
      ?>
      <div id="postbox-container-1" class="postbox-container">
        <div class="meta-box-sortables">
          <div class="postbox">
            <h3><span><?php _e( 'Like this Plugin?', 'smart-user-slug-hider' ); ?></span></h3>
            <div class="inside">
              <ul>
                <li><div class="dashicons dashicons-wordpress"></div>&nbsp;&nbsp;<a href="<?php echo $this->wp_url; ?>/"><?php _e( 'Please rate the plugin', 'smart-user-slug-hider' ); ?></a></li>
                <li><div class="dashicons dashicons-admin-home"></div>&nbsp;&nbsp;<a href="<?php echo $this->my_url; ?>/"><?php _e( 'Plugin homepage', 'smart-user-slug-hider'); ?></a></li>
                <li><div class="dashicons dashicons-admin-home"></div>&nbsp;&nbsp;<a href="http://petersplugins.com"><?php _e( 'Author homepage', 'smart-user-slug-hider' );?></a></li>
                <li><div class="dashicons dashicons-googleplus"></div>&nbsp;&nbsp;<a href="http://g.petersplugins.com"><?php _e( 'Authors Google+ Page', 'smart-user-slug-hider' ); ?></a></li>
                <li><div class="dashicons dashicons-facebook-alt"></div>&nbsp;&nbsp;<a href="http://f.petersplugins.com"><?php _e( 'Authors facebook Page', 'smart-user-slug-hider' ); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="postbox">
            <h3><span><?php _e( 'Translate this Plugin', 'smart-user-slug-hider' ); ?></span></h3>
            <div class="inside">
              <p><?php _e( 'It would be great if you\'d support the smart User Slug Hider Plugin by adding a new translation or keeping an existing one up to date!', 'smart-user-slug-hider' ); ?></p>
              <p><a href="https://translate.wordpress.org/projects/wp-plugins/<?php echo $this->plugin_slug; ?>"><?php _e( 'Translate online', 'smart-user-slug-hider' ); ?></a></p>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
      
    // public functions
    public function get_smart_user_slug( $user_id = false ) {
      $slug = '';
      if ( ! $user_id ) {
        if ( in_the_loop() ) {
          $user_id = get_the_author_meta( 'ID' );
        } else {
          $user_id = get_current_user_id();
        }
      }
      if ( $user_id ) {
        $slug = $this->encrypt( $user_id );
      }
      return $slug;
    }
    
    public function the_smart_user_slug( $user_id = false ) {
      echo get_smart_user_slug( $user_id );
    }
    
    // shortcodes 
    function shortcode_smart_user_slug( $atts, $content=null ) {
      return $this->get_smart_user_slug();
    }
    
    function shortcode_smart_user_url( $atts, $content=null ) {
      // get_author_posts_url calls the author_link, so we don't have to care ourselves...
      return esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
    }
    
    function shortcode_smart_user_link( $atts, $content=null ) {
      // get_author_posts_url calls the author_link, so we don't have to care ourselves...
      return '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a>';
    }
    
  }
  
}