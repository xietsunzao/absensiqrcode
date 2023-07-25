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
