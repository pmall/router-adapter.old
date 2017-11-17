<?php declare(strict_types=1);

namespace Ellipse\Router\Adapter;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

class Handler implements RequestHandlerInterface
{
    /**
     * The dispatcher factory.
     *
     * @var callable
     */
    private $dispatcher;

    /**
     * The middleware stack.
     *
     * @var array
     */
    private $middleware;

    /**
     * The request handler.
     *
     * @var mixed
     */
    private $handler;

    /**
     * Set up a route with the given dispatcher factory, middleware stack and
     * request handler.
     *
     * @param callable  $dispatcher
     * @param array     $middleware
     * @param mixed     $handler
     */
    public function __construct(callable $dispatcher, array $middleware, $handler)
    {
        $this->dispatcher = $dispatcher;
        $this->middleware = $middleware;
        $this->handler = $handler;
    }

    /**
     * Return a response by creating a dispatcher and proxying its ->handle()
     * method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dispatcher = ($this->dispatcher)($this->middleware, $this->handler);

        return $dispatcher->handle($request);
    }

    /**
     * Return a response by proxying ->handle() method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return $this->handle($request);
    }
}
