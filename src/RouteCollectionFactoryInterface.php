<?php declare(strict_types=1);

namespace Ellipse\Router;

interface RouteCollectionFactoryInterface
{
    /**
     * Return a route collection using the given definitions.
     *
     * @param array $definitions
     * @return \Ellipse\Router\RouteCollection
     */
    public function __invoke(array $definitions): RouteCollection;
}
