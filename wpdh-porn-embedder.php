<?php
/**
 * Plugin Name: WPDH Porn Embedder
 * Description: Adds custom porn site oEmbed handlers.
 * Version: 1.0.0
 * Author: DJABHipHop
 * Author URI: https://github.com/WP-Developer-Hub/
 * Plugin URI: https://github.com/WP-Developer-Hub/wpdh-comment-toolbox
 * Requires PHP: 7.2
 * Requires at least: 6.0
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpdhpe
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'inc/wpdh-porn-embedder-site-adder.php';

class WPDH_Porn_Embeder {

    private $site_adder;

    public function __construct() {
        $this->site_adder = new WPDH_Porn_Embedder_Site_Adder();
        $this->add_sites();
    }

    private function add_sites() {
        $this->site_adder->add_porn_site('xhamster.com', '#-([a-zA-Z0-9]+)(?:\?.*)?$#i', 'https://xhamster.com/embed');
        $this->site_adder->add_porn_site('xvideos.com', '#\/video\.([a-zA-Z0-9]+)\/#i', 'https://www.xvideos.com/embedframe');
        $this->site_adder->add_porn_site('pornhub.com', '#viewkey=([\w]+)#i', 'https://www.pornhub.com/embed');
        $this->site_adder->add_porn_site('drtuber.com', '#/video/(\d+)/#i', 'https://www.drtuber.com/embed');
        $this->site_adder->add_porn_site('eporner.com', '#\/video-([a-zA-Z0-9]+)\/#i', 'https://www.eporner.com/embed');
        $this->site_adder->add_porn_site('homemoviestube.com', '#\/videos\/(\d+)\/#i', 'https://www.homemoviestube.com/embed');
        $this->site_adder->add_porn_site('pervertslut.com', '#/videos/(\d+)/#i', 'http://pervertslut.com/embed');
        $this->site_adder->add_porn_site('sunporno.com', '#\/v\/(\d+)\/#i', 'https://sunporno.com/embed');
        $this->site_adder->add_porn_site('tnaflix.com', '#\/video(\d+)#i', 'https://player.tnaflix.com/video');
        $this->site_adder->add_porn_site('pornone.com', '#/(\d+)/#i', 'https://www.pornone.com/embed', '/');
        $this->site_adder->add_porn_site('youjizz.com', '#\-(\d+)\.html#i', 'https://www.youjizz.com/videos/embed');
        $this->site_adder->add_porn_site('redgifs.com', '#\\/watch\/([a-zA-Z0-9]+)#i', 'https://redgifs.com/ifr');
        $this->site_adder->add_porn_site('throne.com', '#.*#i', '');
        $this->site_adder->add_porn_site('discordapp.com', '#.*#i', '');
        $this->site_adder->add_porn_site('kik.me', '#.*#i', '');
        $this->site_adder->add_porn_site('bsky.app', '#.*#i', '');
        $this->site_adder->add_porn_site('t.me', '#.*#i', '');
        $this->site_adder->add_porn_site('onlyfans.com', '#.*#i', '');
        $this->site_adder->add_porn_site('fetlife.com', '#.*#i', '');
        $this->site_adder->add_porn_site('manyvids.com', '#.*#i', '');
        $this->site_adder->add_porn_site('chaturbate.com', '#.*#i', '');
    }
}

new WPDH_Porn_Embeder();
