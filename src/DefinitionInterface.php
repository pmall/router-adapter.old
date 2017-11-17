<?php declare(strict_types=1);

namespace Ellipse\Router;

interface DefinitionInterface
{
    /**
     * Register routes with the route collector.
     *
     * @param mixed                             $key
     * @param \Ellipse\Router\RouteCollector    $collector
     * @param \Ellipse\Router\HandlerFactory    $handler
     */
    public function populate($key, RouteCollector $collector, HandlerFactory $handler): void;
}
