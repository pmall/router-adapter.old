<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

class DefinitionCollection implements DefinitionInterface
{
    /**
     * The collection pattern.
     *
     * @var string
     */
    private $pattern;

    /**
     * The middleware stack specific to this collection.
     *
     * @var iterable
     */
    private $middleware;

    /**
     * This collection definitions.
     *
     * @var array
     */
    private $definitions;

    /**
     * Set up a definition collection with the given array of definitions and
     * optional pattern and middleware stack.
     *
     * @param array     $definitions
     * @param string    $pattern
     * @param iterable  $middleware
     */
    public function __construct(array $definitions, string $pattern = '', iterable $middleware = [])
    {
        $this->definitions = $definitions;
        $this->pattern = $pattern;
        $this->middleware = $middleware;
    }

    /**
     * @inheritdoc
     */
    public function populate($key, RouteCollector $collector, HandlerFactory $handler): void
    {
        $collector = $collector->withPrefixes($key, $this->pattern);
        $handler = $handler->withMiddleware($this->middleware);

        $keys = array_keys($this->definitions);
        $values = array_values($this->definitions);

        array_map(function ($key, $definition) use ($collector, $handler) {

            return $definition->populate($key, $collector, $handler);

        }, $keys, $values);
    }
}
