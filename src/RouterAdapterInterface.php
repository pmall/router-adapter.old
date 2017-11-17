<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

use Psr\Http\Message\ServerRequestInterface;

interface RouterAdapterInterface
{
    /**
     * Register a handler to the mapper.
     *
     * @param string                            $name
     * @param array                             $methods
     * @param string                            $pattern
     * @param \Ellipse\Router\Adapter\Handler   $handler
     * @return mixed
     */
    public function register(string $name, array $methods, string $pattern, Handler $handler);

    /**
     * Return the route matching the given request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Ellipse\Router\Adapter\Match
     * @throws \Ellipse\Router\Exceptions\NotFoundExceptionInterface
     * @throws \Ellipse\Router\Exceptions\MethodNotAllowedExceptionInterface
     */
    public function match(ServerRequestInterface $request): Match;

    /**
     * Return an url from the given route name and parameters.
     *
     * @param string    $name
     * @param array     $parameters
     * @return string
     */
    public function generate(string $name, array $parameters = []): string;
}
