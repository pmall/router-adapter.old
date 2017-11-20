<?php declare(strict_types=1);

namespace Ellipse\Router;

class RouteCollection
{
    /**
     * The router adapter factory.
     *
     * @var callable
     */
    private $factory;

    /**
     * The definition.
     *
     * @var \Ellipse\Router\DefinitionInterface
     */
    private $definition;

    /**
     * Set up a route collection with the given router adapter factory and the
     * given route definition.
     *
     * @param callable                              $factory
     * @param \Ellipse\Router\DefinitionInterface   $definition
     */
    public function __construct(callable $factory, DefinitionInterface $definition)
    {
        $this->factory = $factory;
        $this->definition = $definition;
    }

    /**
     * Return a router adapter populated with the definitions using the given
     * dispatcher factory.
     *
     * @param callable $dispatcher
     * @return \Ellipse\Router\RouterAdapterInterface
     */
    public function toRouterAdapter(callable $dispatcher): RouterAdapterInterface
    {
        $adapter = ($this->factory)();

        $collector = new RouteCollector($adapter);
        $handler = new HandlerFactory($dispatcher);

        $this->definition->populate('', $collector, $handler);

        return $adapter;
    }
}
