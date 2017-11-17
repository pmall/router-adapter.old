<?php declare(strict_types=1);

namespace Ellipse\Router;

class RouteCollection
{
    /**
     * The router adapter.
     *
     * @var \Ellipse\Router\RouterAdapterInterface
     */
    private $adapter;

    /**
     * The definition.
     *
     * @var \Ellipse\Router\DefinitionInterface
     */
    private $definition;

    /**
     * Sert up a route collection with the given router adapter and definition.
     *
     * @param \Ellipse\Router\RouterAdapterInterface    $adapter
     * @param \Ellipse\Router\DefinitionInterface       $definition
     */
    public function __construct(RouterAdapterInterface $adapter, DefinitionInterface $definition)
    {
        $this->adapter = $adapter;
        $this->definition = $definition;
    }

    /**
     * Populate the router adapter with the definitions using the given
     * dispatcher factory.
     *
     * @param callable $dispatcher
     * @return \Ellipse\Router\RouterAdapterInterface
     */
    public function populateWith(callable $dispatcher): RouterAdapterInterface
    {
        $collector = new RouteCollector($this->adapter);
        $handler = new HandlerFactory($dispatcher);

        $this->definition->populate('', $collector, $handler);

        return $this->adapter;
    }
}
