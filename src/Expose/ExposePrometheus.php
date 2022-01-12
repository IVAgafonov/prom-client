<?php

namespace PromClient\Expose;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\APC;

class ExposePrometheus {
    public static function expose(): string
    {
        $registry = new CollectorRegistry(new APC());

        $renderer = new RenderTextFormat();
        return $renderer->render($registry->getMetricFamilySamples());
    }
}
