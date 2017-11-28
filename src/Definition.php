<?php declare(strict_types=1);

namespace Ellipse\Router;

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
     * The route custom setup.
     *
     * @var callable
     */
    private $setup;

    /**
     * Set up a route with the given methods, pattern, middleware stack, request
     * handler and setup.
     *
     * @param array     $methods
     * @param string    $pattern
     * @param mixed     $handler
     * @param iterable  $middleware
     * @param callable  $setup
     */
    public function __construct(array $methods, string $pattern, $handler, iterable $middleware = [], callable $setup = null)
    {
        $this->methods = $methods;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->middleware = $middleware;
        $this->setup = $setup;
    }

    /**
     * Return a new Definition with the given middleware.
     *
     * @param callable $setup
     * @return \Ellipse\Route\Definition
     */
    public function setup(callable $setup): Definition
    {
        return new Definition($this->methods, $this->pattern, $this->handler, $this->middleware, $setup);
    }

    /**
     * @inheritdoc
     */
    public function populate($key, RouteCollector $collector, HandlerFactory $handler): void
    {
        $handler = $handler($this->middleware, $this->handler);

        $collector->register($key, $this->methods, $this->pattern, $handler, $this->setup);
    }
}
