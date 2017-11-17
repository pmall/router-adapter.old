<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

interface RouteCollectionFactoryInterface
{
    /**
     * Return a route collection using the given definitions.
     *
     * @param array $definitions
     * @return \Ellipse\Router\Adapter\RouteCollection
     */
    public function __construct(array $definitions): RouteCollection;
}
