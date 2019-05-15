<?php

/**
 * Hooks - WP bigbo's hook system
 *
 * @package WPbigbo
 * @subpackage WP_bigbo
 */

/**
 * bigbo_hook_before_html() short description.
 *
 * Long description.
 *
 * @since 0.3
 * @hook action bigbo_hook_before_html
 */
function bigbo_hook_before_html() {
    do_action('bigbo_hook_before_html');
}

/**
 * bigbo_hook_after_html() short description.
 *
 * Long description.
 *
 * @since 0.3
 * @hook action bigbo_hook_after_html
 */
function bigbo_hook_after_html() {
    do_action('bigbo_hook_after_html');
}

