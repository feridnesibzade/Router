<?php 

namespace Ferid\Router;

use Closure;
use Ferid\Router\Interfaces\RouterInterface;

class Router extends RouterHandler implements RouterInterface {

    protected static $url; 
    protected static $handler; 

    public static function get(string $url, Closure | string | array $handler)
    {
        self::$url = $url;
        self::$handler = $handler;
        
        if(self::urlCheck($url) && self::methodCheck('GET')){
            echo self::result($handler);
        }
    }

    public static function post(string $url, Closure | string | array $handler)
    {
        self::$url = $url;
        self::$handler = $handler;
        
        if(self::urlCheck($url) && self::methodCheck('POST')){
            echo self::result($handler);
        }
    }

    
    public static function put(string $url, Closure | string | array $handler)
    {
        self::$url = $url;
        self::$handler = $handler;
        
        if(self::urlCheck($url) && self::methodCheck('PUT')){
            echo self::result($handler);
        }
    }
    
    public static function patch(string $url, Closure | string | array $handler)
    {
        self::$url = $url;
        self::$handler = $handler;
        
        if(self::urlCheck($url) && self::methodCheck('PATCH')){
            echo self::result($handler);
        }
    }

    public static function delete(string $url, Closure | string | array $handler)
    {
        self::$url = $url;
        self::$handler = $handler;
        
        if(self::urlCheck($url) && self::methodCheck('DELETE')){
            echo self::result($handler);
        }
    }
}