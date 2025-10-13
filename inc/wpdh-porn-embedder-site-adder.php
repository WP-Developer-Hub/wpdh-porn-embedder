<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPDH_Porn_Embedder_Site_Adder {
    private $handlers = [];

    public function __construct() {
        add_action('init', [$this, 'register_handlers']);
    }

    public function add_porn_site(string $name, string $regex, string $endpoint, string $suffix = '') {
        $this->handlers[$name] = [
            'regex' => $regex,
            'endpoint' => $endpoint,
            'suffix' => $suffix,
        ];
    }

    public function register_handlers() {
        foreach ($this->handlers as $name => $config) {
            wp_embed_register_handler($name, $config['regex'], [$this, 'handle_embed']);
        }
    }

    public function handle_embed($matches, $attr, $url, $rawattr) {
        $width  = isset($attr['width']) ? esc_attr($attr['width']) : '100%';
        $height = isset($attr['height']) ? esc_attr($attr['height']) : '512px';

        foreach ($this->handlers as $handler_name => $config) {
            if (false !== strpos($url, $handler_name)) {
                $video_id = '';

                if (preg_match_all($config['regex'], $url, $all_matches, PREG_OFFSET_CAPTURE)) {
                    $video_id = $all_matches[1][0][0] ?? '';
                }

                if (!empty($video_id)) {
                    $embed_url = rtrim($config['endpoint'], '/') . '/' . esc_attr($video_id);
                    if (!empty($config['suffix'])) {
                        $embed_url .= $config['suffix'];
                    }
                    return '<div class="u-media-16-9 u-pos-rel" style="display: block; overflow: hidden"><iframe src="' . esc_url($embed_url) . '" width="' . $width . '" height="100%" frameborder="0" allowfullscreen loading="lazy" scrolling="no" allowtransparency="true" class="u-pos-abs"></iframe></div>';
                } else {
                    return $this->get_mshot_link($url, $width, $height);
                }
            }
        }
        return '';
    }

    public function get_mshot_link($url, $width = 300, $height = 200) {
        // Encode URL for mShots API
        $encoded_url = rawurlencode($url);

        // Construct mShots image URL
        $mshot_url = "https://s.wordpress.com/mshots/v1/{$encoded_url}?w={$width}&h={$height}";

        // Return HTML with image preview wrapped in anchor tag
        return '<div class="post-media u-media-16-9"><a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" >' .
               '<img src="' . esc_url($mshot_url) . '" alt="Preview of ' . esc_attr($url) . '" loading="lazy" />' .
               '</a></div>';
    }
}
