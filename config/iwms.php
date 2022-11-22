<?php

return [
    'api_base_url' => env('IWMS_API_BASE_URL', ''),
    'root_token' => env('IWMS_ROOT_TOKEN', ''),
    'current_user_token' =>env('IWMS_API_USER_TOKEN', ''),
    'system' => env('IWMS_API_SYSTEM', 'customer'),
];
