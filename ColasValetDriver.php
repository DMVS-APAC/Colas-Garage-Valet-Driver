<?php

namespace Valet\Drivers\Custom;

use Valet\Drivers\ValetDriver;

class ColasValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return bool
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        if (file_exists($sitePath.'/Dailymotion.php')) {
          return true; 
        }

        return false;
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string|false
     */
    public function isStaticFile($sitePath, $siteName, $uri)
    {
        if (file_exists($staticFilePath = $sitePath.'/public/'.$uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): ?string
    {
       $url_param = parse_url($_SERVER['REQUEST_URI'])['path'];

       if ( strpos($url_param, 'css') === false && 
         strpos($url_param, 'img') === false && 
         strpos($url_param, 'fonts') === false ) {
         return $sitePath.'/controller.php';
       }

        return $sitePath . $uri;
    }
}

