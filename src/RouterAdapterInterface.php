<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;

interface RouterAdapterInterface
{
    /**
     * Register a handler to the mapper.
     *
     * @param string                    $name
     * @param array                     $methods
     * @param string                    $pattern
     * @param \Ellipse\Router\Handler   $handler
     * @return mixed
     */
    public function register(string $name, array $methods, string $pattern, Handler $handler);

    /**
     * Return the route matching the given request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Ellipse\Router\Match
     * @throws \Ellipse\Router\Exceptions\NotFoundException
     * @throws \Ellipse\Router\Exceptions\MethodNotAllowedException
     */
    public function match(ServerRequestInterface $request): Match;

    /**
     * Return an url from the given route name and parameters.
     *
     * @param string    $name
     * @param array     $parameters
     * @return string
     * @throws \Ellipse\Router\Exceptions\RouteNameNotFoundException
     */
    public function generate(string $name, array $parameters = []): string;
}
