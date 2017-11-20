<?php declare(strict_types=1);

namespace Ellipse\Router;

class DefinitionFactory
{
    /**
     * Return a definition collection from an array and a callable reducer.
     *
     * @param array $elements
     * @param callable $reducer
     * @return \Ellipse\Router\DefinitionCollection
     */
    public static function reduce(array $elements, callable $reducer): DefinitionCollection
    {
        $routes = array_reduce($elements, $reducer, []);

        return new DefinitionCollection($routes);
    }

    /**
     * Return a definition collection containing the given routes.
     *
     * @param array $routes
     * @return \Ellipse\Router\DefinitionCollection
     */
    public static function collection(array $routes): DefinitionCollection
    {
        return new DefinitionCollection($routes);
    }

    /**
     * Return a definition collection with the given pattern.
     *
     * @param string    $pattern
     * @param array     $routes
     * @return \Ellipse\Router\DefinitionCollection
     */
    public static function pattern(string $pattern, array $routes): DefinitionCollection
    {
        return new DefinitionCollection($routes, $pattern);
    }

    /**
     * Return a definition collection with the given middleware stack.
     *
     * @param iterable  $middleware
     * @param array     $routes
     * @return \Ellipse\Router\DefinitionCollection
     */
    public static function middleware(iterable $middleware, array $routes): DefinitionCollection
    {
        return new DefinitionCollection($routes, '', $middleware);
    }

    /**
     * Return a definition collection with the given pattern and middleware stack.
     *
     * @param string    $pattern
     * @param iterable  $middleware
     * @param array     $routes
     * @return \Ellipse\Router\DefinitionCollection
     */
    public static function group(string $pattern, iterable $middleware, array $routes): DefinitionCollection
    {
        return new DefinitionCollection($routes, $pattern, $middleware);
    }

    /**
     * Return a route using the GET method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function get(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['GET'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route using the POST method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function post(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['POST'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route using the PUT method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function put(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['PUT'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route using the DELETE method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function delete(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['DELETE'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route using the HEAD method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function head(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['HEAD'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route using the OPTIONS method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function options(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['OPTIONS'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route using the PATCH method.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function patch(string $pattern, $handler, iterable $middleware = []): Definition
    {
        return new Definition(['PATCH'], $pattern, $handler, $middleware);
    }

    /**
     * Return a route mathing any given methods.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function any(array $methods, string $pattern, $handler, iterable $middleware = [])
    {
        return new Definition($methods, $pattern, $handler, $middleware);
    }

    /**
     * Return a route mathing all methods.
     *
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @return \Ellipse\Router\Definition
     */
    public static function all(string $pattern, $handler, iterable $middleware = [])
    {
        $methods = ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS', 'PATCH'];

        return new Definition($methods, $pattern, $handler, $middleware);
    }
}
