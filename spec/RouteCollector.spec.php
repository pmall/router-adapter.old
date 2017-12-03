<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Router\RouterAdapterInterface;
use Ellipse\Router\RouteCollector;
use Ellipse\Router\Handler;

describe('RouteCollector', function () {

    beforeEach(function () {

        $this->adapter = mock(RouterAdapterInterface::class);
        $this->setup = stub();

        $this->collector = new RouteCollector($this->adapter->get(), 'namespace', '/prefix');

    });

    describe('->withPrefixes()', function () {

        it('should return a new route collector', function () {

            $test = $this->collector->withPrefixes('key', '/pattern');

            $collector = new RouteCollector($this->adapter->get(), 'namespace.key', '/prefix/pattern');

            expect($test)->toEqual($collector);
            expect($test)->not->toBe($this->collector);

        });

    });

    describe('->register()', function () {

        beforeEach(function () {

            $this->handler = mock(Handler::class)->get();

        });

        it('should register a route with an empty name when the given key is not a string', function () {

            $this->collector->register(0, ['GET'], '/test', $this->handler, $this->setup);

            $this->adapter->register->calledWith('', '~', '~', '~', '~');

        });

        it('should register a route with the given string key as name suffix', function () {

            $this->collector->register('key', ['GET'], '/test', $this->handler, $this->setup);

            $this->adapter->register->calledWith('namespace.key', '~', '~', '~', '~');

        });

        it('should register a route with the given methods uppercased', function () {

            $this->collector->register('key', ['get', 'post'], '/test', $this->handler, $this->setup);

            $this->adapter->register->calledWith('~', ['GET', 'POST'], '~', '~', '~');

        });

        it('should register a route with the given pattern as pattern suffix', function () {

            $this->collector->register('key', ['GET'], '/pattern', $this->handler, $this->setup);

            $this->adapter->register->calledWith('~', '~', '/prefix/pattern', '~', '~');

        });

        it('should register a route with the given setup callable', function () {

            $this->collector->register('key', ['GET'], '/test', $this->handler, $this->setup);

            $this->adapter->register->calledWith('~', '~', '~', '~', $this->setup);

        });

        it('should register a route with the given handler', function () {

            $this->collector->register('key', ['GET'], '/test', $this->handler, $this->setup);

            $this->adapter->register->calledWith('~', '~', '~', $this->handler, '~');

        });

    });

});
