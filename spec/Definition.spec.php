<?php

use function Eloquent\Phony\Kahlan\mock;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Adapter\DefinitionInterface;
use Ellipse\Router\Adapter\Definition;
use Ellipse\Router\Adapter\RouteCollector;
use Ellipse\Router\Adapter\HandlerFactory;

describe('Definition', function () {

    beforeEach(function () {

        $this->middleware = ['middleware'];
        $this->handler = mock(RequestHandlerInterface::class)->get();

        $this->definition = new Definition(['GET', 'POST'], '/pattern', $this->handler, $this->middleware);

    });

    it('should implement DefinitionInterface', function () {

        expect($this->definition)->toBeAnInstanceOf(DefinitionInterface::class);

    });

    describe('->populate()', function () {

        beforeEach(function () {

            $this->collector = mock(RouteCollector::class);
            $this->factory = mock(HandlerFactory::class);

        });

        it('should call the route collector ->register() method with given key', function () {

            $this->definition->populate('key', $this->collector->get(), $this->factory->get());

            $this->collector->register->calledWith('key', '~', '~', '~');

        });

        it('should call the route collector ->register() method with the definition methods', function () {

            $this->definition->populate('key', $this->collector->get(), $this->factory->get());

            $this->collector->register->calledWith('~', ['GET', 'POST'], '~', '~');

        });

        it('should call the route collector ->register() method with the definition pattern', function () {

            $this->definition->populate('key', $this->collector->get(), $this->factory->get());

            $this->collector->register->calledWith('~', '~', '/pattern', '~');

        });

        it('should use the given handler factory to create a handler and register it', function () {

            $this->definition->populate('key', $this->collector->get(), $this->factory->get());

            $this->factory->__invoke->calledWith($this->middleware, $this->handler);

            $handler = $this->factory->__invoke->firstCall()->returnValue();

            $this->collector->register->calledWith('~', '~', '~', $handler);

        });

    });

});
