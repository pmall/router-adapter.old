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

            expect($test)->toBeAnInstanceOf(DefinitionCollection::class);

        });

    });

    describe('::collection()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();

            $test = DefinitionFactory::collection([$route]);

            expect($test)->toBeAnInstanceOf(DefinitionCollection::class);

        });

    });

    describe('::pattern()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();

            $test = DefinitionFactory::pattern('/pattern', [$route]);

            expect($test)->toBeAnInstanceOf(DefinitionCollection::class);

        });

    });

    describe('::middleware()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();
            $middleware = 'middleware';

            $test = DefinitionFactory::middleware([$middleware], [$route]);

            expect($test)->toBeAnInstanceOf(DefinitionCollection::class);

        });

    });

    describe('::group()', function () {

        it('should return a new DefinitionCollection', function () {

            $route = mock(Definition::class)->get();
            $middleware = 'middleware';

            $test = DefinitionFactory::group('/pattern', [$middleware], [$route]);

            expect($test)->toBeAnInstanceOf(DefinitionCollection::class);

        });

    });

    describe('::get()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::get('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::get('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::post()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::post('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::post('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::put()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::put('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::put('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::delete()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::delete('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::delete('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::head()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::head('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::head('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::options()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::options('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::options('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::patch()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::patch('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::patch('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::any()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::any(['GET', 'POST'], '/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::any(['GET', 'POST'], '/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

    describe('::all()', function () {

        it('should return a new Definition', function () {

            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::all('/pattern', $handler);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

        it('should return a new Definition with specific middleware', function () {

            $middleware = 'middleware';
            $handler = mock(RequestHandlerInterface::class)->get();

            $test = DefinitionFactory::all('/pattern', $handler, [$middleware]);

            expect($test)->toBeAnInstanceOf(Definition::class);

        });

    });

});
