<?php

namespace PromClient\Expose;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

class ExposePrometheus {
    public static function expose(): string
    {
        $registry = CollectorRegistry::getDefault();

        $renderer = new RenderTextFormat();
        return $renderer->render($registry->getMetricFamilySamples());
    }
}
