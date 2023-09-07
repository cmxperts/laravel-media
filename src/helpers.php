<?php

// For add'active' class for activated route nav-item
use Illuminate\Support\Facades\Storage;

if (!function_exists('active_class')) {
    function active_class($path, $active = 'active')
    {
        $path = getPath($path);
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}

// For checking activated route
if (!function_exists('is_active_route')) {
    function is_active_route($path)
    {
        $path = getPath($path);
        return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
    }
}

// For add 'show' class for activated route collapse
if (!function_exists('show_class')) {
    function show_class($path)
    {
        $path = getPath($path);
        return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            return app('url')->asset('storage/' . $path, $secure);
        }
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}

if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL() . 'storage/';
        }
    }
}

if (! function_exists('getCondition')) {
    function getCondition($conditions)
    {
        $result = null;
        if (! isset($conditions)) {
            return false;
        }

        if (count($conditions) > 0) {
            if (count($conditions) == 1) {
                return $conditions[0]['condition'];
            } else {
                foreach ($conditions as $condition) {
                    if (isset($condition['type']) && isset($condition['condition'])) {
                        if ($condition['type'] == 'or' || $condition['type'] == 'Or' || $condition['type'] == 'OR' || $condition['type'] == '||') {
                            $result = $result || $condition['condition'];
                        } elseif ($condition['type'] == 'and' || $condition['type'] == 'And' || $condition['type'] == 'AND' || $condition['type'] == '&&') {
                            $result = $result && $condition['condition'];
                        }
                    }
                }
            }

            return $result;
        } else {
            return false;
        }
    }
}

if (! function_exists('getPath')) {
    function getPath($path)
    {
        if(is_array($path)) {
            $originalArray = $path;
            $newArray = [];

            foreach ($originalArray as $element) {
                $newArray[] = $element . '*';
            }
            return $newArray;
        } else {
            $path = $path .'*';
        }
        return $path;
    }
}
