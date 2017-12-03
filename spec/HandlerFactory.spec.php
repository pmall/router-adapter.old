<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Handler;
use Ellipse\Router\HandlerFactory;

describe('HandlerFactory', function () {

    beforeEach(function () {

        $this->dispatcher = stub();
        $this->middleware = ['middleware1'];

        $this->factory = new HandlerFactory($this->dispatcher, $this->middleware);

    });

    describe('->withMiddleware()', function () {

        context('when the given middleware stack is an array', function () {

            it('should return a new handler factory with the given middleware', function () {

                $middleware = ['middleware2'];

                $test = $this->factory->withMiddleware($middleware);

                $factory = new HandlerFactory($this->dispatcher, ['middleware1', 'middleware2']);

                expect($test)->toEqual($factory);
                expect($test)->not->toBe($this->factory);

            });

        });

        context('when the given middleware stack is an iterator', function () {

            it('should return a new handler factory', function () {

                $middleware = ['middleware2'];

                $middleware = new ArrayObject($middleware);

                $test = $this->factory->withMiddleware($middleware);

                $factory = new HandlerFactory($this->dispatcher, ['middleware1', 'middleware2']);

                expect($test)->toEqual($factory);
                expect($test)->not->toBe($this->factory);

            });

        });

    });

    describe('->__invoke()', function () {

        context('when the given middleware stack is an array', function () {

            it('should return a new Handler using the given middleware stack and handler', function () {

                $middleware = ['middleware2'];

                $handler = mock(RequestHandlerInterface::class)->get();

                $test = $this->factory->__invoke($middleware, $handler);

                $handler = new Handler($this->dispatcher, ['middleware1', 'middleware2'], $handler);

                expect($test)->toEqual($handler);

            });

        });

        context('when the given middleware stack is an iterator', function () {

            it('should return a new Handler using the given middleware stack and handler', function () {

                $middleware = ['middleware2'];

                $middleware = new ArrayObject($middleware);

                $handler = mock(RequestHandlerInterface::class)->get();

                $test = $this->factory->__invoke($middleware, $handler);

                $handler = new Handler($this->dispatcher, ['middleware1', 'middleware2'], $handler);

                expect($test)->toEqual($handler);

            });

        });

    });

});
