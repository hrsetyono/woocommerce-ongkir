<?php
/**
 * Plugin Name:       Ongkir Indonesia for WooCommerce
 * Plugin URI:        http://github.com/hrsetyono/wc-ongkir-indonesia
 * Description:       Calculate the shipping costs for Indonesian couriers like JNE, J&T, Ninja Xpress, Sicepat, TIKI, POS, etc. Requires RajaOngkir PRO License.
 * Version:           2.4.2
 * Author:            Pixel Studio
 * Author URI:        https://pixelstudio.id/
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wc-ongkir-indonesia
 */

if (!defined('ABSPATH')) { exit; } // exit if accessed directly

// Abort if WooCommerce not installed
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  return;
}

define('ONGKIR_VERSION', '2.4.2');
define('ONGKIR_FILE', plugins_url('', __FILE__));
define('ONGKIR_DIR', __DIR__);
define('ONGKIR_NAMESPACE', 'ongkir/v1');
define('ONGKIR_API', get_site_url() . '/wp-json/' . ONGKIR_NAMESPACE);


require_once __DIR__ . '/includes/ongkir-api.php';
require_once __DIR__ . '/admin/index.php';
require_once __DIR__ . '/public/index.php';

if (!function_exists('ongkir_run_plugin')):
  /**
   * Run the plugin
   */
  function ongkir_run_plugin() {
    $settings = get_option('woocommerce_ongkir_settings');
    $enabled = isset($settings['enabled']) ? $settings['enabled'] : 'no';

    new Ongkir_Admin($enabled);
    new Ongkir_Public($enabled);
    new Ongkir_API();
  }

  ongkir_run_plugin();
endif;