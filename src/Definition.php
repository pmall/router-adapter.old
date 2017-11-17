<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

class Definition implements DefinitionInterface
{
    /**
     * The route methods.
     *
     * @var array
     */
    private $methods;

    /**
     * The route pattern.
     *
     * @var string
     */
    private $pattern;

    /**
     * The middleware stack specific to this definition.
     *
     * @var iterable
     */
    private $middleware;

    /**
     * The request handler.
     *
     * @var mixed
     */
    private $handler;

    /**
     * Set up a route with the given methods, pattern, middleware stack and
     * request handler.
     *
     * @param array     $methods
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     */
    public function __construct(array $methods, string $pattern, $handler, iterable $middleware = [])
    {
        $this->methods = $methods;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->middleware = $middleware;
    }

    /**
     * @inheritdoc
     */
    public function populate($key, RouteCollector $collector, HandlerFactory $handler): void
    {
        $handler = $handler($this->middleware, $this->handler);

        $collector->register($key, $this->methods, $this->pattern, $handler);
    }
}
