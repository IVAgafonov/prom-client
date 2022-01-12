<?php

namespace PromClient\Metrics;


use PromClient\Init\PromMetricInit;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\APC;

class Histogram extends AbstractPrometheus
{

    /**
     * @var \Prometheus\Histogram
     */
    private \Prometheus\Histogram $histogram;

    /**
     * @param string $metric_name
     * @param array $values
     * @param string[] $labels
     */
    public function __construct(string $metric_name, array $values, array $labels)
    {
        parent::__construct($labels);
        $registry = new CollectorRegistry(new APC());
        $this->histogram = $registry->getOrRegisterHistogram(
            PromMetricInit::$namespace,
            $metric_name.'_histogram',
            '',
            $this->label_names,
            $values
        );
    }

    /**
     * @param int|float $value
     */
    public function observe($value): void
    {
        $this->histogram->observe($value, $this->label_values);
    }
}
