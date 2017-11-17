<?php

namespace Ellipse\Router\Adapter\Exceptions;

use RuntimeException;

class RouteNameNotMappedException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct(string $name)
    {
        $msg = "The route name '%s' is not mapped to a route.";

        parent::__construct(sprintf($msg, $name));
    }
}
