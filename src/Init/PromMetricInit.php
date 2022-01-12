<?php

namespace PromClient\Init;

class PromMetricInit {

    public static string $namespace = 'default';

    /**
     * @param string $namespace
     */
    public static function init(string $namespace = 'default'): void
    {
        PromMetricInit::$namespace = $namespace;
    }
}
