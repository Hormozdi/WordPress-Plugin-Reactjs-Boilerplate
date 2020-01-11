<?php
/**
 * Plugin Name:       WordPress Plugin Reactjs Boilerplate
 * Plugin URI:        https://github.com/Hormozdi/WordPress-Plugin-Reactjs-Boilerplate
 * Description:       [WordPress] A foundation for WordPress Plugin Development that aims to use Reactjs in your plugins.
 * Version:           1.0.0
 * Author:            Hoomaan Hormozdi
 * Author URI:        https://github.com/Hormozdi
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-plugin-reactjs-boilerplate
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class WordpressReactjsPlugin {
    private $plugin_name;
    private $version;

    public function __construct() {
		$this->plugin_name = 'wordpress-plugin-reactjs-boilerplate';
        $this->version = '1.0.0';

        add_shortcode( 'footag', [$this, 'footag_func'] );

        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_filter( 'script_loader_tag', [$this, 'enqueue_babale_type_scripts'], 10, 3);
    }
    
    public function footag_func() {
        return '<dic id="my-app"></div>';
    }
    
    public function enqueue_scripts() {
		wp_enqueue_script(
            $this->plugin_name . 'babel',
            'https://unpkg.com/babel-standalone@6.15.0/babel.min.js',
            array( 'jquery' ),
            $this->version,
            true
        );
        wp_enqueue_script(
            $this->plugin_name . 'react',
            'https://unpkg.com/react@16/umd/react.development.js',
            array( $this->plugin_name . 'babel' ),
            $this->version,
            true
        );
		wp_enqueue_script(
            $this->plugin_name . 'react-dom',
            'https://unpkg.com/react-dom@16/umd/react-dom.development.js',
            array( $this->plugin_name . 'react' ),
            $this->version,
            true
        );
		wp_enqueue_script(
            $this->plugin_name . 'react-base',
            plugin_dir_url( __FILE__ ) . 'react-base.js',
            array( $this->plugin_name . 'react-dom' ),
            $this->version,
            true
        );
    }
    
    public function enqueue_babale_type_scripts( $tag, $handle, $src ) {
        if ( $this->plugin_name . 'react-base' === $handle ) {
            $tag = '';
            $dirs = scandir( __DIR__ . DIRECTORY_SEPARATOR . 'components');
            foreach ($dirs as $dir) {
                if(strpos($dir, '.') !== false) continue;
                $tag .= '<script type="text/babel" src="' . esc_url( plugin_dir_url( __FILE__ ) . 'components/' . $dir . '/index.js' ) . '"></script>';
            }
            $tag .= '<script type="text/babel" src="' . esc_url( $src ) . '"></script>';
        }
        return $tag;
    }
}

new WordpressReactjsPlugin();