<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;
use function Eloquent\Phony\Kahlan\anInstanceOf;

use Ellipse\Router\RouteCollection;
use Ellipse\Router\RouterAdapterInterface;
use Ellipse\Router\Definition;
use Ellipse\Router\Handler;

describe('RouteCollection', function () {

    beforeEach(function () {

        $this->factory = stub();
        $this->definition = new Definition(['GET'], '/pattern', 'handler');

        $this->collection = new RouteCollection($this->factory, $this->definition);

        $this->dispatcher = stub();

    });

    describe('->toRouterAdapter()', function () {

        beforeEach(function () {

            $this->adapter = mock(RouterAdapterInterface::class);

            $this->factory->returns($this->adapter);

        });

        it('should return the router adapter', function () {

            $test = $this->collection->toRouterAdapter($this->dispatcher);

            expect($test)->toBe($this->adapter->get());

        });

        it('should populate the adapter with the definition', function () {

            $this->collection->toRouterAdapter($this->dispatcher);

            $this->adapter->register->calledWith('', ['GET'], '/pattern', anInstanceOf(Handler::class));

        });

    });

});
