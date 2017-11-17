<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;
use function Eloquent\Phony\Kahlan\partialMock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Adapter\Handler;

describe('Handler', function () {

    beforeEach(function () {

        $this->dispatcher = stub();
        $this->middleware = ['middleware'];
        $this->final = mock(RequestHandlerInterface::class)->get();

        $this->handler = new Handler(
            $this->dispatcher,
            $this->middleware,
            $this->final
        );

    });

    it('should implement RequestHandlerInterface', function () {

        expect($this->handler)->toBeAnInstanceOf(RequestHandlerInterface::class);

    });

    describe('->handle()', function () {

        it('should use the dispatcher factory to create a request handler and proxy its ->handle() method', function () {

            $request = mock(ServerRequestInterface::class)->get();
            $response = mock(ResponseInterface::class)->get();
            $dispatcher = mock(RequestHandlerInterface::class);

            $this->dispatcher->with($this->middleware, $this->final)->returns($dispatcher);

            $dispatcher->handle->with($request)->returns($response);

            $test = $this->handler->handle($request);

            expect($test)->toBe($response);

        });

    });

    describe('->__invoke()', function () {

        it('should proxy the ->handle() method', function () {

            $request = mock(ServerRequestInterface::class)->get();
            $response = mock(ResponseInterface::class)->get();

            $handler = partialMock(Handler::class, [
                $this->dispatcher,
                $this->middleware,
                $this->final
            ]);

            $handler->handle->with($request)->returns($response);

            $test = ($handler->get())($request);

            expect($test)->toBe($response);

        });

    });

});
