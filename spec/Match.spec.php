<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Match;
use Ellipse\Router\Handler;

describe('Match', function () {

    beforeEach(function () {

        $this->name = 'name';
        $this->handler = mock(Handler::class);
        $this->attributes = ['k1' => 'v1', 'k2' => 'v2'];

        $this->match = new Match($this->name, $this->handler->get(), $this->attributes);

    });

    it('should implement RequestHandlerInterface', function () {

        expect($this->match)->toBeAnInstanceOf(RequestHandlerInterface::class);

    });

    describe('->__toString()', function () {

        it('should return the match name', function () {

            expect((string) $this->match)->toEqual($this->name);

        });

    });

    describe('->handle()', function () {

        beforeEach(function () {

            $this->request1 = mock(ServerRequestInterface::class);
            $this->request2 = mock(ServerRequestInterface::class);
            $this->request3 = mock(ServerRequestInterface::class);

            $this->request1->withAttribute->returns($this->request2);
            $this->request2->withAttribute->returns($this->request3);

        });

        it('should append all the attributes to the given request', function () {

            $this->match->handle($this->request1->get());

            $this->request1->withAttribute->calledWith('k1', 'v1');
            $this->request2->withAttribute->calledWith('k2', 'v2');

        });

        it('should proxy the handler ->handle() method with the modified request', function () {

            $response = mock(ResponseInterface::class)->get();

            $this->handler->handle->returns($response);

            $test = $this->match->handle($this->request1->get());

            expect($test)->toBe($response);

        });

    });

});
