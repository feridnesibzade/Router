<?php

namespace Ferid\Router;

use ErrorException;

class RouterHandler {

    protected static array $params = [];

    protected static function urlCheck($url) : bool
    {
        if(self::urlFilter($url)){
            return true;
        }else{
            return false;
        }
    }

    protected static function stringHandler($handler)
    {
        list($class, $method) = explode('@', $handler);
        $className = "\Ferid\Router\Tests\TestControllers\\$class";

        if(class_exists($className) && method_exists($className, $method)){
            return (new $className())->$method(...array_values(self::$params) ?? null);
        }else{
            throw new ErrorException("$class or $method not found", 0);
        }
    }

    protected static function arrayHandler($handler)
    {
        list($class, $method) = $handler;
        
        if(class_exists($class) && method_exists($class, $method)){
            return (new $class())->$method(...array_values(self::$params) ?? null);
        }else{
            throw new ErrorException("$class or $method not found", 0);
        }
    }
    
    protected static function objectHandler($handler)
    {
        return call_user_func($handler, ...array_values(self::$params) ?? null);
    }

    public static function result($handler)
    {
        switch(gettype($handler)){
            case 'string':
                return self::stringHandler($handler);
            break;

            case 'array':
                return self::arrayHandler($handler);
            break;

            case 'object':
                return self::objectHandler($handler);
            break;
        }
    }

    public static function methodCheck($method)
    {
        if($_SERVER['REQUEST_METHOD'] == $method){
            return true;
        }else{
            throw new ErrorException($_SERVER['REQUEST_METHOD']." method not allowed. Allowed method ( $method )");
        }
    }

    public static function urlFilter($url)
    {
        if(count(explode("/", $url)) == count(explode("/", $_SERVER['REQUEST_URI']))){
            foreach(explode("/", $url) as $key => $urlItem){
                if(preg_match('/{*}/', $urlItem)){
                    self::$params[trim($urlItem, "{}")] = explode("/", $_SERVER['REQUEST_URI'])[$key];
                }else{
                    if(explode("/", $_SERVER['REQUEST_URI'])[$key] != $urlItem){
                        return false;
                    }
                }
            }
            return true;
        }
    }
}