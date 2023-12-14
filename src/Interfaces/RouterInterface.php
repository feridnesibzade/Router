<?php 

namespace Ferid\Router\Interfaces;

use Closure;

interface RouterInterface {
    public static function get(string $url, Closure | string | array $handler);
    
    public static function post(string $url, Closure | string | array $handler);

    public static function put(string $url, Closure | string | array $handler);
    
    public static function patch(string $url, Closure | string | array $handler);
    
    public static function delete(string $url, Closure | string | array $handler);
}