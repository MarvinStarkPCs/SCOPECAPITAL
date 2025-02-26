<?php

if (!function_exists('generate_request_code')) {
    function generate_request_code()
    {
        return 'REQ-' . strtoupper(bin2hex(random_bytes(3)));
    }
}
