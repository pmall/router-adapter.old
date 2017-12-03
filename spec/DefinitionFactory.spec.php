<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\DefinitionFactory;
use Ellipse\Router\DefinitionCollection;
use Ellipse\Router\Definition;

describe('DefinitionFactory', function () {

    describe('::reduce()', function () {

        it('should return a new DefinitionCollection', function () {

            $elements = ['element'];
            $reducer = stub();
            $route = mock(Definition::class)->get();

            allow('array_reduce')->toBeCalled()->with($elements, $reducer)->andReturn([$route]);

            $test = DefinitionFactory::reduce($elements, $reducer);

            $collection = new DefinitionCollection([$route]);

            expect($test)->toEqual($collection);

        });

    });

    describe('::collection()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();

            $test = DefinitionFactory::collection([$route]);

            $collection = new DefinitionCollection([$route]);

            expect($test)->toEqual($collection);

        });

    });

    describe('::pattern()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();

            $test = DefinitionFactory::pattern('/pattern', [$route]);

            $collection = new DefinitionCollection([$route], '/pattern');

            expect($test)->toEqual($collection);

        });

    });

    describe('::middleware()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();
            $middleware = 'middleware';

            $test = DefinitionFactory::middleware([$middleware], [$route]);

            $collection = new DefinitionCollection([$route], '', [$middleware]);

            expect($test)->toEqual($collection);

        });

    });

    describe('::group()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();
            $middleware = 'middleware';

            $test = DefinitionFactory::group('/pattern', [$middleware], [$route]);

            $collection = new DefinitionCollection([$route], '/pattern', [$middleware]);

            expect($test)->toEqual($collection);

        });

    });

    describe('::get()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::get('/pattern', $handler);

            $definition = new Definition(['GET'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::get('/pattern', $handler, [$middleware]);

            $definition = new Definition(['GET'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::post()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::post('/pattern', $handler);

            $definition = new Definition(['POST'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::post('/pattern', $handler, [$middleware]);

            $definition = new Definition(['POST'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::put()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::put('/pattern', $handler);

            $definition = new Definition(['PUT'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::put('/pattern', $handler, [$middleware]);

            $definition = new Definition(['PUT'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::delete()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::delete('/pattern', $handler);

            $definition = new Definition(['DELETE'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::delete('/pattern', $handler, [$middleware]);

            $definition = new Definition(['DELETE'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::head()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::head('/pattern', $handler);

            $definition = new Definition(['HEAD'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::head('/pattern', $handler, [$middleware]);

            $definition = new Definition(['HEAD'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::options()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::options('/pattern', $handler);

            $definition = new Definition(['OPTIONS'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::options('/pattern', $handler, [$middleware]);

            $definition = new Definition(['OPTIONS'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::patch()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::patch('/pattern', $handler);

            $definition = new Definition(['PATCH'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::patch('/pattern', $handler, [$middleware]);

            $definition = new Definition(['PATCH'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::any()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::any(['GET', 'POST'], '/pattern', $handler);

            $definition = new Definition(['GET', 'POST'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::any(['GET', 'POST'], '/pattern', $handler, [$middleware]);

            $definition = new Definition(['GET', 'POST'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

    describe('::all()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::all('/pattern', $handler);

            $definition = new Definition(['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS', 'PATCH'], '/pattern', $handler, []);

            expect($test)->toEqual($definition);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::all('/pattern', $handler, [$middleware]);

            $definition = new Definition(['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS', 'PATCH'], '/pattern', $handler, [$middleware]);

            expect($test)->toEqual($definition);

        });

    });

});
