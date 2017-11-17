<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

class RouteCollection
{
    /**
     * The router adapter.
     *
     * @var \Ellipse\Router\Adapter\RouterAdapterInterface
     */
    private $adapter;

    /**
     * The definition.
     *
     * @var \Ellipse\Router\Adapter\DefinitionInterface
     */
    private $definition;

    /**
     * Sert up a route collection with the given router adapter and definition.
     *
     * @param \Ellipse\Router\Adapter\RouterAdapterInterface  $adapter
     * @param \Ellipse\Router\Adapter\DefinitionInterface     $definition
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
     * @return \Ellipse\Router\Adapter\RouterAdapterInterface
     */
    public function populateWith(callable $dispatcher): RouterAdapterInterface
    {
        $collector = new RouteCollector($this->adapter);
        $handler = new HandlerFactory($dispatcher);

        $this->definition->populate('', $collector, $handler);

        return $this->adapter;
    }
}
