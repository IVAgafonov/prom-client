<?php

namespace PromClient\Init;

class PromMetricInit {

    public static string $namespace = 'default';

    /**
     * @param string $namespace
     * @param array $redis_options [host, port, pass]
     */
    public static function init(string $namespace = 'default', array $redis_options = []): void
    {
        PromMetricInit::$namespace = $namespace;

        \Prometheus\Storage\Redis::setDefaultOptions(
            [
                'host' => $redis_options['host'] ?? 'localhost',
                'port' => $redis_options['port'] ?? 6379,
                'password' => $redis_options['pass'] ?? null,
                'timeout' => 1, // in seconds
                'read_timeout' => '10', // in seconds
                'persistent_connections' => false
            ]
        );
    }
}
