<?php

use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Router\DefinitionInterface;
use Ellipse\Router\DefinitionCollection;
use Ellipse\Router\RouteCollector;
use Ellipse\Router\HandlerFactory;

describe('DefinitionCollection', function () {

    beforeEach(function () {

        $this->definition1 = mock(DefinitionInterface::class);
        $this->definition2 = mock(DefinitionInterface::class);

        $this->definitions = [
            'definition' => $this->definition1->get(),
            $this->definition2->get(),
        ];

        $this->middleware = ['middleware'];

        $this->collection = new DefinitionCollection(
            $this->definitions,
            '/pattern',
            $this->middleware
        );

    });

    it('should implement DefinitionInterface', function () {

        expect($this->collection)->toBeAnInstanceOf(DefinitionInterface::class);

    });

    describe('->populate()', function () {

        beforeEach(function () {

            $this->collector = mock(RouteCollector::class);
            $this->factory = mock(HandlerFactory::class);

        });

        it('should call each definition ->populate() method with its key', function () {

            $this->collection->populate('key', $this->collector->get(), $this->factory->get());

            $this->definition1->populate->calledWith('definition', '*');
            $this->definition2->populate->calledWith(0, '*');

        });

        it('should call each definition ->populate() method with a prefixed route collector', function () {

            $this->collection->populate('key', $this->collector->get(), $this->factory->get());

            $this->collector->withPrefixes->calledWith('key', '/pattern');

            $prefixed = $this->collector->withPrefixes->firstCall()->returnValue();

            $this->definition1->populate->calledWith('~', $prefixed, '*');
            $this->definition2->populate->calledWith('~', $prefixed, '*');

        });

        it('should call each definition ->populate() method with an updated handler factory', function () {

            $this->collection->populate('key', $this->collector->get(), $this->factory->get());

            $this->factory->withMiddleware->calledWith($this->middleware);

            $updated = $this->factory->withMiddleware->firstCall()->returnValue();

            $this->definition1->populate->calledWith('~', '~', $updated);
            $this->definition2->populate->calledWith('~', '~', $updated);

        });

    });

});
