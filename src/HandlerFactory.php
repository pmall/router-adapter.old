<?php declare(strict_types=1);

namespace Ellipse\Router;

use Traversable;

class HandlerFactory
{
    /**
     * The dispatcher factory.
     *
     * @var callable
     */
    private $dispatcher;

    /**
     * The middleware stack.
     *
     * @var array
     */
    private $middleware;

    /**
     * Set up a handler factory with the given dispatcher factory and middleware
     * stack.
     *
     * @param callable  $dispatcher
     * @param array     $middleware
     */
    public function __construct(callable $dispatcher, array $middleware = [])
    {
        $this->dispatcher = $dispatcher;
        $this->middleware = $middleware;
    }

    /**
     * Return a new handler factory with the given middleware stack appended to
     * its current middleware stack.
     *
     * @param iterable $middleware
     * @return \Ellipse\Router\HandlerFactory
     */
    public function withMiddleware(iterable $middleware): HandlerFactory
    {
        $middleware = $this->mergeStacks($this->middleware, $middleware);

        return new HandlerFactory($this->dispatcher, $middleware);
    }

    /**
     * Return a new Handler from the given element.
     *
     * @param iterable  $middleware
     * @param mixed     $handler
     * @return \Ellipse\Router\Handler
     */
    public function __invoke(iterable $middleware, $handler): Handler
    {
        $middleware = $this->mergeStacks($this->middleware, $middleware);

        return new Handler($this->dispatcher, $middleware, $handler);
    }

    /**
     * Merge an array of middleware with an iterable list of middleware.
     *
     * @param array     $current
     * @param iterable  $middleware
     * @return array
     */
    private function mergeStacks(array $current, iterable $middleware): array
    {
        $middleware = $middleware instanceof Traversable
            ? iterator_to_array($middleware)
            : $middleware;

        return array_merge($current, $middleware);
    }
}
