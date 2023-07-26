<!-- this is helper for authentication -->

<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('is_login')) {
    function is_login()
    {
        $ci = get_instance();
        if (!$ci->ion_auth->logged_in()) {
            redirect('auth');
        }
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        $ci = get_instance();
        if (!$ci->ion_auth->is_admin()) {
            redirect('auth');
        }
    }
}

if (!function_exists('user')) {
    function user()
    {
        $ci = get_instance();
        if (!$ci->ion_auth->logged_in()) {
            return false;
        }
        $user = $ci->ion_auth->user()->row();
        return $user;
    }
}
