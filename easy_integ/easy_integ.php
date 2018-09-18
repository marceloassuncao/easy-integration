<?php
/**
 * Plugin Name: Easy Integration.
 * Description: Integration of anything.
 * Author: Marcelo Assunção.
 * Version: 1.0.0
 */ 

if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;

define( 'INTEG_PATH', plugin_dir_path(__FILE__) );
define( 'INTEG_URL', plugin_dir_url(__FILE__) );

define( 'INTEG_INCLUDES_PATH', plugin_dir_path(__FILE__) . 'includes/' ) ;
define( 'INTEG_INCLUDES_URL', plugin_dir_url(__FILE__) . 'includes/' );

define( 'INTEG_VIEWS_PATH', plugin_dir_path(__FILE__) . 'views/' ) ;
define( 'INTEG_VIEWS_URL', plugin_dir_url(__FILE__) . 'views/' );

define( 'INTEG_ASSETS_PATH', plugin_dir_path(__FILE__)  . 'assets/' );
define( 'INTEG_ASSETS_URL', plugin_dir_url(__FILE__)  . 'assets/' );

if( ! class_exists( 'easyInteg' ) ) :

    Class easyInteg {

        /**
         * Instance of this class
         * 
         * @var object
         */
        protected static $easyInteg = null;

        /**
         * Initialize plugin loaders
         */
        private function __construct(){
            
                /**
                 * Add plugin Stylesheet and JavaScript, in frontend
                 */
                add_action( 'wp_enqueue_scripts', array( $this, 'integ_enqueue_scripts' ) );

                /**
                 * Add plugin Stylesheet and JavaScript, in admin
                 */
                add_action( 'admin_enqueue_scripts', array( $this, 'integ_admin_enqueue_scripts' ) );

                /**
                 * Add Options to save
                 */
                add_action('admin_init',  array( $this, 'register_my_cool_plugin_settings' ) );
                
                /**
                 * Include plugin files
                 */
                $this->integ_enqueue_includes();
                $this->integ_enqueue_views();
            
        }

        public static function integ_start(){
            if( self::$easyInteg == null ) :
                self::$easyInteg = new self;
            endif;
    
            return self::$easyInteg;
        }

        public function integ_enqueue_scripts()
        {
            wp_enqueue_script( 'integ-script', INTEG_ASSETS_URL . 'js/easy-integ-frontend.js' );

            wp_enqueue_style( 'integ-style', INTEG_ASSETS_URL . 'css/easy-integ-frontend.css' );

        }

        public function integ_admin_enqueue_scripts()
        {
            wp_enqueue_script( 'integ-admin-script', INTEG_ASSETS_URL . 'js/easy-integ-backend.js' );
    
            wp_enqueue_style( 'integ-admin-style', INTEG_ASSETS_URL . 'css/easy-integ-backend.css' );
        }

        private function integ_enqueue_includes()
        {
            include_once INTEG_INCLUDES_PATH . 'class-easy-integ.php';
        }
        private function integ_enqueue_views()
        {
            include_once INTEG_VIEWS_PATH . 'view-easy-integ.php';
        }


    }

    //Start's when plugins are loaded plugin
    add_action( 'plugins_loaded', array( 'easyInteg', 'integ_start') );

endif;