<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Handler;
use Ellipse\Router\HandlerFactory;

describe('HandlerFactory', function () {

    beforeEach(function () {

        $this->dispatcher = stub();
        $this->middleware = ['middleware'];

        $this->factory = new HandlerFactory($this->dispatcher, $this->middleware);

    });

    describe('->withMiddleware()', function () {

        context('when the given middleware stack is an array', function () {

            it('should return a new handler factory', function () {

                $middleware = ['middleware'];

                $test = $this->factory->withMiddleware($middleware);

                expect($test)->toBeAnInstanceOf(HandlerFactory::class);
                expect($test)->not->toBe($this->factory);

            });

        });

        context('when the given middleware stack is an iterator', function () {

            it('should return a new handler factory', function () {

                $middleware = ['middleware'];

                $middleware = new ArrayObject($middleware);

                $test = $this->factory->withMiddleware($middleware);

                expect($test)->toBeAnInstanceOf(HandlerFactory::class);
                expect($test)->not->toBe($this->factory);

            });

        });

    });

    describe('->__invoke()', function () {

        context('when the given middleware stack is an array', function () {

            it('should return a new Handler using the given middleware stack and handler', function () {

                $middleware = ['middleware'];

                $handler = mock(RequestHandlerInterface::class)->get();

                $test = $this->factory->__invoke($middleware, $handler);

                expect($test)->toBeAnInstanceOf(Handler::class);

            });

        });

        context('when the given middleware stack is an iterator', function () {

            it('should return a new Handler using the given middleware stack and handler', function () {

                $middleware = ['middleware'];

                $middleware = new ArrayObject($middleware);

                $handler = mock(RequestHandlerInterface::class)->get();

                $test = $this->factory->__invoke($middleware, $handler);

                expect($test)->toBeAnInstanceOf(Handler::class);

            });

        });

    });

});
