<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

class Match implements RequestHandlerInterface
{
    /**
     * The match name.
     *
     * @var string
     */
    private $name;

    /**
     * The match handler.
     *
     * @var \Ellipse\Router\Adapter\Handler
     */
    private $handler;

    /**
     * The match attributes.
     *
     * @var array
     */
    private $attributes;

    /**
     * Set up a matched route with the given name, handler and attributes.
     *
     * @param string                            $name
     * @param \Ellipse\Router\Adapter\Handler   $handler
     * @param array                             $attributes
     */
    public function __construct(string $name, Handler $handler, array $attributes = [])
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    /**
     * Display the match name as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add the attributes to the given request and return a response by proxying
     * the handler ->handle() method.
     *
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @return Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $keys = array_keys($this->attributes);

        $request = array_reduce($keys, function ($request, $key) {

            return $request->withAttribute($key, $this->attributes[$key]);

        }, $request);

        return $this->handler->handle($request);
    }
}
