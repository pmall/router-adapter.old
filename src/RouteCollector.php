<?php declare(strict_types=1);

namespace Ellipse\Router;

class RouteCollector
{
    /**
     * The router adapter.
     *
     * @var \Ellipse\Router\Contracts\RouterAdapterInterface
     */
    private $adapter;

    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * The pattern.
     *
     * @var string
     */
    private $pattern;

    /**
     * Set up a context with the given router adapter, name and pattern.
     *
     * @param \Ellipse\Router\RouterAdapterInterface    $adapter
     * @param string                                    $name
     * @param string                                    $pattern
     */
    public function __construct(RouterAdapterInterface $adapter, string $name = '', string $pattern = '')
    {
        $this->adapter = $adapter;
        $this->name = $name;
        $this->pattern = $pattern;
    }

    /**
     * Return a new route collector with the given key and pattern appended to
     * its current name and pattern.
     *
     * @param mixed     $key
     * @param string    $name
     * @return \Ellipse\Router\RouteCollector
     */
    public function withPrefixes($key, string $pattern): RouteCollector
    {
        $name = $this->mergeNames($this->name, $key);
        $pattern = $this->mergePatterns($this->pattern, $pattern);

        return new RouteCollector($this->adapter, $name, $pattern);
    }

    /**
     * Return a new Route from the given key, methods and handler.
     *
     * @param mixed     $key
     * @param array     $methods
     * @param string    $pattern
     * @param mixed     $handler
     * @param callable  $setup
     * @return void
     */
    public function register($key, array $methods, string $pattern, Handler $handler, callable $setup = null): void
    {
        $name = is_string($key) ? $this->mergeNames($this->name, $key) : '';
        $methods = array_map('strtoupper', $methods);
        $pattern = $this->mergePatterns($this->pattern, $pattern);

        $this->adapter->register($name, $methods, $pattern, $handler, $setup);
    }

    /**
     * Return the concatenation of the given name and the given key.
     *
     * @param string    $name
     * @param mixed     $key
     * @return string
     */
    private function mergeNames(string $name, $key): string
    {
        $parts = [];

        if ($name != '') $parts[] = $name;
        if (is_string($key)) $parts[] = $key;

        return implode('.', $parts);
    }

    /**
     * Return the concatenation of the given patterns.
     *
     * @param string $pattern1
     * @param string $pattern2
     * @return string
     */
    private function mergePatterns(string $pattern1, string $pattern2): string
    {
        return $pattern1 . $pattern2;
    }
}
